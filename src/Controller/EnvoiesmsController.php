<?php

namespace App\Controller;

use App\Controller\FpilyonController;
use App\Entity\Fpilyon;
use App\Entity\User;
use App\Entity\smspartnerapi;
use App\Form\FpilyonType;
use App\Repository\FpilyonRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/envoiesms")
 */
class EnvoiesmsController extends AbstractController
{

     /**
     * @var FpilyonRepository
     */
    private $repository;
    
   /**
    * @var EntityManagerInterface $em 
    */
    private $em;
    
     public function __construct(FpilyonRepository $repository, EntityManagerInterface $em)
     {
        $this->repository = $repository;
        $this->em = $em;
     }

      /**
     * @Route("/general/{number_phone}/{message_phone}", name="envoiesms_general")
     */
    public function envoiesms(Request $request, $number_phone, $message_phone): Response
    {
      //  en attente des variables "message_phone" et "number_phone"
            if (isset($message_phone) && isset($number_phone)) {

                    $postUrl = "https://sms.capitolemobile.com/api/sendsms/xml.php";
                    //Structure de Données XML
                    $xmlString = '<SMS>
                                                <authentification>
                                                     <username>0778343941</username>
                                                     <password>Erick2691</password>
                                             </authentification>
                                                 <message>
                                                         <long>yes</long>
                                                         <text> '.$message_phone.' </text>
                                                         <sender>FPI FRANCE</sender>
                                                 </message>
                                             <recipients>
                                                     <gsm>'.$number_phone.'</gsm>
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
              //      echo $response;
             return $this->render('adhesion/envoiesmsok.html.twig');

                }
                
            
        return $this->render('adhesion/bravoAdherent.html.twig');

    }

}
