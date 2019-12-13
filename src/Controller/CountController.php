<?php

namespace App\Controller;

use App\Controller\CountController;
use App\Controller\ObjectManager;
use App\Entity\Count;
use App\Entity\adhesion;
use App\Form\CountType;
use App\Repository\CountRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/count")
 */
class CountController extends AbstractController
{
    /**
     * @Route("/", name="count_index", methods={"GET"})
     */
    public function index(CountRepository $countRepository): Response
    {
        return $this->render('count/index.html.twig', [
            'counts' => $countRepository->findAll(),
        ]);
    }

    /**
     * @Route("/abonnement", name="count_abonnement", methods={"GET","POST"})
     */
    public function createAbonnement(Request $request) 
    {
        $user = $this->getUser();
        // if(empty($user->getAdhesion())){
           
        // }
        $adhesion = $user->getAdhesion();

        $count = new Count();

        $count->setRef('Abonnement')
              ->setDescription('paiement abonnement')
              ->setRemise('0')
              ->setPUnHt('5')
              ->setTva(0);
     
        $form= $this->createFormBuilder($count)
        // ->add('ref')
        // ->add('description')
        // ->add('remise')
        // ->add('pUnHt')
        ->add('qte')

        ->getForm();
  
        $form->handleRequest($request);
        $count->setPUnHtRem($count->getPUnHt() - (($count->getPUnHt() / 100) * ($count->getRemise())));
        $count->setPrixTotHt(($count->getPUnHtRem()) * ($count->getQte()));
        $count->setTotalTtc(($count->getPrixTotHt()) + (($count->getPrixTotHt() / 100) * ($count->getTva())));

        // $count->setPUnHtRem($count->getPUnHt()'

        $count->setAdhesion($adhesion);

     // dump($count);

        if($form->isSubmitted() && $form->isValid()) {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($count);
        $entityManager->flush();

     return $this->redirectToRoute('count_show',[
         'id' => $count->getId(),
     ]);
     }

        return $this->render('count/create.html.twig', [
            'formCount' => $form->createView()
        ]);
    }

        /**
     * @Route("/article", name="count_article", methods={"GET","POST"})
     */
    public function createArticle(Request $request) 
    {
        $count = new Count();

        // $count->setRef("Abonements")
        //       ->setPUnH(51);
        $form= $this->createFormBuilder($count)
        ->add('ref')
        ->add('pUnHt')
        ->add('qte')
        ->getForm();
  
        $form->handleRequest($request);
        dump($count);

        return $this->render('count/create.html.twig', [
            'formCount' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/attestation", name="count_attestation")
     */
    public function attestation(CountRepository $countRepository):Response
    {
        $user = $this->getUser();
        $adhesion = $user->getAdhesion();
        $adhesionId = $adhesion->getId();
        $adhesionfirstname = $adhesion->getFirstName();
        $counts = $countRepository->findBy(
            array('adhesion' => $adhesionId) // Critere 
        );
        
       
        //return new Response('et alors');
        return $this->render('count/attestation.html.twig'
        ,[
            'counts' => $counts,
            'adhesionId' => $adhesionId,
            'adhesionfirstname' => $adhesionfirstname
        ]);
    }

    /**
     * @Route("/new", name="count_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = $this->getUser();
        $adhesion = $user->getAdhesion();
        $adhesionId = $user->getAdhesion()->getId();
        
        $count = new Count();
        $count->setAdhesion($adhesion);
        $form_count = $this->createForm(CountType::class, $count);
        $count->setRef('abonnement');
        
        $form_count->handleRequest($request);
        // on lie la facturette à l'adherent
        $count->setAdhesion($adhesion);

        if ($form_count->isSubmitted() && $form_count->isValid()) {
           
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($count);
            $entityManager->flush();

            return $this->redirectToRoute('count_index');
        }

        return $this->render('count/new.html.twig', [
            'adhesion' => $adhesion,
        //    'adhesion_id' =>$adhesionId,
            'count' => $count,
            'form_count' => $form_count->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="count_show", methods={"GET"})
     */
    public function show(Count $count): Response
    {
        return $this->render('count/show.html.twig', [
            'count' => $count,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="count_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Count $count): Response
    {
        $form = $this->createForm(CountType::class, $count);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('count_index');
        }

        return $this->render('count/edit.html.twig', [
            'count' => $count,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="count_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Count $count): Response
    {
        if ($this->isCsrfTokenValid('delete'.$count->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($count);
            $entityManager->flush();
        }

        return $this->redirectToRoute('count_index');
    }
    
    public function __toString()
    {
        return (string) $this->getTicket();
    }

   

   
    
}
