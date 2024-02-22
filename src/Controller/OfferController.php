<?php

namespace App\Controller;
use App\Form\OfferType;
use App\Entity\Offer;
use App\Repository\OfferRepository;
use Doctrine\Persistence\ManagerRegistry; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class OfferController extends AbstractController
{
    #[Route('/offerList', name: 'app_offer_index', methods: ['GET'])]
    public function index(OfferRepository $offerRepository): Response
    {
        return $this->render('Back/offer/index.html.twig', [
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
        return $this->renderForm('Back/offer/new.html.twig', [
            'offer' => $offer,
            'form' => $form,
            'page_title' => 'Offers',
            'active_page' => 'New offer',
        ]);
        }
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

        return $this->renderForm('Back/offer/edit.html.twig', [
            'offer' => $o,
            'form' => $form,
            'page_title' => 'Offer Space',
            'active_page' => 'Add Your Offer',
        ]);
        
    }
    #[Route('/deleteOffer{id}', name: 'app_offer_delete')]
    public function remove($id,ManagerRegistry $mr,OfferRepository $repo) : Response {
        $offer=$repo->find($id);
        $em=$mr->getManager();
        $em->remove($offer);
        $em->flush();
        return $this->redirectToRoute('app_offer_index');
        }



        #[Route('/OfferCruds', name: 'app_offer_front')]
    public function indexf(OfferRepository $offerRepository): Response
    {
        return $this->render('Front/Offer/frontCruds.html.twig', [
            'offers' => $offerRepository->findAll(),
        ]);
    }

    #[Route('/newFOffer', name: 'front_offer_new')]
    public function newf(ManagerRegistry $mr,Request $request,): Response
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
            return $this ->redirectToRoute('app_offer_front');    
        }
        return $this->renderForm('Front/offer/new.html.twig', [
            'offer' => $offer,
            'form' => $form,
        ]);
        }
    #[Route('/editFOffer/{id}', name: 'front_offer_edit')]
    public function editf( $id, ManagerRegistry $mr, Request $request, OfferRepository $repo): Response
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

        return $this->renderForm('Front/offer/edit.html.twig', [
            'offer' => $o,
            'form' => $form,
        ]);
        
    }
    #[Route('/deleteOffer{id}', name: 'app_offer_delete')]
    public function removef($id,ManagerRegistry $mr,OfferRepository $repo) : Response {
        $offer=$repo->find($id);
        $em=$mr->getManager();
        $em->remove($offer);
        $em->flush();
        return $this->redirectToRoute('app_offer_front');
        }

}
