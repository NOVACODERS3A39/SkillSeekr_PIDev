<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignUpController extends AbstractController
{
    #[Route('/signup', name: 'app_sign_up')]
    public function index(): Response
    {
        return $this->render('back/sign_up/index.html.twig', [
            'controller_name' => 'SignUpController',
        ]);
    }



    #[Route('/reset-password', name: 'app_reset_password')]
    public function resetPassword(): Response
    {
        return $this->render('back/sign_up/reset-password.html.twig', [
            'controller_name' => 'SignUpController',
        ]);
    }
}
