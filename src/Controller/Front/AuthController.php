<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class Front/AuthController extends AbstractController
{
    #[Route('/front/auth', name: 'app_front_auth')]
    public function index(): Response
    {
        return $this->render('front/auth/index.html.twig', [
            'controller_name' => 'Front/AuthController',
        ]);
    }
}
