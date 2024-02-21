<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndextestController extends AbstractController
{
    #[Route('/indextest', name: 'app_indextest')]
    public function index(): Response
    {
        $offers = 'sql';
        return $this->render('Back/pages/indextest/index.html.twig', [
            'page_title' => 'Feed',
            'active_page' => 'Feed',
            'offers' => $offers
        ]);
    }
}
