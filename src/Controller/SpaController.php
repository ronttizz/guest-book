<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpaController extends AbstractController
{
    #[Route('/', name: 'app_index', methods:["GET"])]
    public function index(): Response
    {
        return $this->render('spa/index.html.twig', [
            'controller_name' => 'SpaController',
        ]);
    }

    #[Route('/create', name: 'app_create')]
    public function create(): Response
    {
        return $this->redirectToRoute('app_index');
    }
}
