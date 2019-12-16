<?php

namespace App\Controller;

use App\Entity\Adhesion;
use App\Entity\Count;
use App\Entity\User;
use App\Repository\AdhesionRepository;
use App\Repository\CountRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/admin")
     */
class AdminController extends AbstractController
{
     /**
     * @Route("/listepaiements", name="admin_listepaiements")
     */
    public function listepaiements(CountRepository $countRepository):Response
    {
        return $this->render('admin/listepaiements.html.twig', [
            'listepaiements' => $countRepository->findAll()
        ]); 
    }

    /**
     * @Route("/listesympatisants", name="admin_listesympatisants")
     */
    public function listesympatisants(UserRepository $userRepository):Response
    {
        return $this->render('admin/listesympatisants.html.twig', [
            'listesympatisants' => $userRepository->findAll()
        ]); 
    }

    /**
     * @Route("/listeadherents", name="admin_listeadherents")
     */
    public function listeadherents(AdhesionRepository $adhesionRepository):Response
    {
        return $this->render('admin/listeadherents.html.twig', [
            'listeadherents' => $adhesionRepository->findAll()
        ]); 
    }

    /**
     * @Route("/listecommandes", name="admin_listecommandes")
     */
    public function listecommandes(AdhesionRepository $adhesionRepository):Response
    {
        return $this->render('admin/listecommandes.html.twig', [
            'listecommandes' => $adhesionRepository->findAll()
        ]); 
    }
}
