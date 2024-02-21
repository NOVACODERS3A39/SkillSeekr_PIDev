<?php

namespace App\Controller;
use App\Form\OfferType;
use App\Entity\Status;
use App\Entity\User;
use App\Entity\Offer;
use App\Repository\OfferRepository;
use Doctrine\Persistence\ManagerRegistry; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class OfferController extends AbstractController
{
    #[Route('/offerList', name: 'app_offer_index', methods: ['GET'])]
    public function index(OfferRepository $offerRepository): Response
    {
        return $this->render('back/offer/index.html.twig', [
            'offers' => $offerRepository->findAll(),
            'page_title' => 'Offers',
            'active_page' => 'Offers list',
        ]);
    }

    #[Route('/newOffer', name: 'app_offer_new')]
    public function new(ManagerRegistry $mr,Request $request,): Response
    {
        $offer = new Offer();
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){    
           //dd($form);
            $em = $mr->getManager(); 
            $em->persist($offer);
            $em->flush();
            $this->addFlash('success', 'Offer created successfully!');
            return $this ->redirectToRoute('app_offer_index');    
        }
        return $this->renderForm('back/offer/new.html.twig', [
            'offer' => $offer,
            'form' => $form,
            'page_title' => 'Offers',
            'active_page' => 'New offer',
        ]);
        }

    // #[Route('/showOffer{id}', name: 'app_offer_show')]
    // public function show(Offer $offer): Response
    // {
    //     return $this->render('offer/show.html.twig', [
    //         'offer' => $offer,
    //     ]);
    // }

    #[Route('/editOffer/{id}', name: 'app_offer_edit')]
    public function edit( $id, ManagerRegistry $mr, Request $request, OfferRepository $repo): Response
    { $o = $repo->find($id);
        if (!$o) {
            throw $this->createNotFoundException('Offer not found.');
        }
    
        $form = $this->createForm(OfferType::class, $o);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $em = $mr->getManager();
            $em->persist($o);
            $em->flush();
            $this->addFlash('success', 'Offer has been updated successfully!');
            return $this->redirectToRoute('app_offer_index');
        }

        return $this->renderForm('back/offer/edit.html.twig', [
            'offer' => $o,
            'form' => $form,
            'page_title' => 'Offer Space',
            'active_page' => 'Add Your Offer',
        ]);
        
    }
    #[Route('/deleteOffer{id}', name: 'app_offer_delete')]
    public function removeP($id,ManagerRegistry $mr,OfferRepository $repo) : Response {
        $offer=$repo->find($id);
        $em=$mr->getManager();
        $em->remove($offer);
        $em->flush();
        return $this->redirectToRoute('app_offer_index');
        }

 
}
