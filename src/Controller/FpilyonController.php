<?php

namespace App\Controller;

use App\Controller\FpilyonController;
use App\Entity\Fpilyon;
use App\Entity\smspartnerapi;
use App\Form\FpilyonType;
use App\Repository\FpilyonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/fpilyon")
 */
class FpilyonController extends AbstractController
{
    /**
     * @Route("/", name="fpilyon_index", methods={"GET"})
     */
    public function index(FpilyonRepository $fpilyonRepository): Response
    {
        return $this->render('fpilyon/index.html.twig', [
            'fpilyons' => $fpilyonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="fpilyon_new")
     */
    public function new(Request $request): Response
    {
        $fpilyon = new Fpilyon();
        $form = $this->createForm(FpilyonType::class, $fpilyon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fpilyon);
            $entityManager->flush();

            return $this->redirectToRoute('fpilyon_index');
        }

        return $this->render('fpilyon/new.html.twig', [
            'fpilyon' => $fpilyon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fpilyon_show", methods={"GET"})
     */
    public function show(Fpilyon $fpilyon): Response
    {
        return $this->render('fpilyon/show.html.twig', [
            'fpilyon' => $fpilyon,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="fpilyon_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Fpilyon $fpilyon): Response
    {
        $form = $this->createForm(FpilyonType::class, $fpilyon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fpilyon_index');
        }

        return $this->render('fpilyon/edit.html.twig', [
            'fpilyon' => $fpilyon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fpilyon_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Fpilyon $fpilyon): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fpilyon->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fpilyon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fpilyon_index');
    }
}
