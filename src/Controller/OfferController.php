<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Form\OfferType;
use App\Repository\LocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OfferController extends AbstractController
{
    #[Route('/offer', name: 'offer_locations')]
    public function index(LocationRepository $locationRepository): Response
    {   
        $locations = $locationRepository->findAll();

        return $this->render('offer/index.html.twig', [
            'controller_name' => 'Nos offres',
            'page_name'       => 'Offres',
            'locations'       => $locations,
        ]);
    }

    #[Route('/offer/add', name: 'offer_add', methods: ["GET", "POST"])]
    public function offerAdd(Request $request, EntityManagerInterface $em):Response
    {   
        $offer = new Offer;
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($offer);
            $em->flush();

            $this->addFlash('success', 'L\'annonce a bien été enregistrée.');

            return $this->redirectToRoute('offer_locations');
        }


        return $this->render('offer/offer_add.html.twig', [
            'controller_name' => 'Offer add',
            'page_name'       => 'Ajouter une offre',
            'form'            => $form,
        ]);
    }
    
}
