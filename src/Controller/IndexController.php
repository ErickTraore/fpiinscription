<?php

namespace App\Controller;

// activation sms ligne 122

use App\Controller\IndexController;
use App\Controller\ObjectManager;
use App\Entity\Adhesion;
use App\Entity\User;
use App\Form\ResetPasswordType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use symfony\Component\Form\Extension\Core\Type\HiddenType;

  
class IndexController extends AbstractController
{
    /**
     *@var UserRepository
     *
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    

    /**
     * 
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/home.html.twig');
    }

    /**
     * 
     * @Route("/show/{id}", name="show")
     */
    public function show(User $user)
    {
       
        return $this->render('security1/show.html.twig',[
            'user'=> $user,
        ]);
    }

     /**
     * 
     * @Route("/forgetpass", name="forgetpass")
     */
    public function forgetpass(Request $request)
   //  public function forgetpass(Request $request, ObjectManager $manager)
    { 
        
         $user = new User();
         $form = $this->createFormBuilder($user)
                ->add('username')  
                ->add('save',SubmitType::class, ['label' => 'Envoyer'])
                ->getForm();
         $form->handleRequest($request);
         if ($form->isSubmitted()) {
             
                    if ($user) {
                            return $this->redirectToRoute('forgetpassafter', [
                            'user' => $user,
                            'myusername' => $user->getUsername(), 
                            ]);

                            } 
         } 
         return $this->render('security2/forgetpass.html.twig', [
            'formUser' =>$form->createView(),
        ]); 
    } 

    /**
     * 
     * @Route("/forgetpassafter/{myusername}", name="forgetpassafter")
     */
    public function forgetpassafter(Request $request, $myusername):Response
    {
        $repository = $this->getDoctrine()
                   ->getManager()
                   ->getRepository(User::class);
        $user = $this->repository->findOneBy(array('username' => $myusername));

        if (! $user) {
            return $this->redirectToRoute('forgetpass');
        }
        $insertisok = false;
        $numrand =  rand (1000, 9999);
        $pass = $numrand ;
        $pass_hash = password_hash($pass, PASSWORD_BCRYPT);
        if (password_verify($pass, $pass_hash))
        {
          $testrand = "fpiinscription.com Votre Mot de passe provisoire est: $pass";
          $user->setPassword($pass_hash);
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->flush();
//        debut sms
        $username = $user->getUsername();
        $request->getSession()->getFlashBag()->add('notice', 'Inscription bien enregistrée.');
        $message_inscription = $testrand;
        //vérouillage ou dévérouillage des envois sms grace à $insertisok
        $insertisok = false;
        if ($insertisok) {

                                // CapitoleMobile POST URL
        $postUrl = "https://sms.capitolemobile.com/api/sendsms/xml.php";
        //Structure de Données XML
        $xmlString = '<SMS>
                                                <authentification>
                                                        <username>0778343941</username>
                                                        <password>Erick2691</password>
                                                </authentification>
                                                    <message>
                                                            <long>yes</long>
                                                            <text> '.$message_inscription.' </text>
                                                            <sender>FPI FRANCE</sender>
                                                    </message>
                                                <recipients>
                                                        <gsm>'.$username.'</gsm>
                                                </recipients>
                                        </SMS>';
                // insertion du nom de la variable POST "XML" avant les données au format XML
                $fields = "XML=" . urlencode(utf8_encode($xmlString));
                // dans cet exemple, la requête POST est realisée grâce à la librairie Curl
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $postUrl);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                // Réponse de la requête POST
                $response = curl_exec($ch);
                curl_close($ch);
                // Ecriture de la réponse
                echo $response;
                $insertisok = false;
            }
          
          return $this->render('security2/forgetpassafter.html.twig', [
              'numrand'=> $numrand,
              'numhash'=> $pass_hash,
              'testrand'=> $testrand,
              ]);
        }
        return $this->redirectToRoute('forgetpass');

        
    } 
    
 /**
     * @Route("/editecheance/{adhesionId}",name="echeance", methods={"GET","POST"})
     * @param Request            $request
     * @param UserRepository $repository
     * @return Response
     */   
public function editecheance(Request $request, $adhesionId):Response
{
  $nbremois = 112;
  $user=$this->getUser();
  $em = $this->getDoctrine()->getManager();

  // On récupère l'annonce
  $user = $em->getRepository(User::class)->find($adhesionId);

  $echeance = $user->getAdhesion()->getDateecheancebis();
  $dateDepart = $echeance;
  $duree = $nbremois;
  $dateDepart->modify('+'.$duree.'months');
  $date = $dateDepart->format('Y-m-d H:i:s.u');
  // On modifie l'URL de l'image par exemple
  
  $user->getAdhesion()->setDateecheancebis($dateDepart);
  $user->getAdhesion()->setLastName('erick');

  // On n'a pas besoin de persister l'annonce ni l'image.
  // Rappelez-vous, ces entités sont automatiquement persistées car
  // on les a récupérées depuis Doctrine lui-même
  
  // On déclenche la modification
  $em->flush();

  return new Response('OK');
}
}
        
    
    
    
    
 

  