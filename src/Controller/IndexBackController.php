<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexBackController extends AbstractController
{
    #[Route('/indexback', name: 'app_index_back')]
    public function index(): Response
    {
        $offers = 'sql';
        return $this->render('Back/pages/indexback/index.html.twig', [
            'page_title' => 'Offres',
            'active_page' => 'Offers',
            'offers' => $offers
        ]);
    }
}
