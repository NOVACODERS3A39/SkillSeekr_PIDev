<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OfferFrontController extends AbstractController
{
    #[Route('Front/offer/front', name: 'app_offer_front')]
    public function index(): Response
    {
        return $this->render('Front/Offer/index.html.twig', [
            'controller_name' => 'OfferFrontController',
        ]);
    }
}
