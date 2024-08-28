<?php

namespace App\Controller;

use App\Repository\LocationRepository;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class ApiController extends AbstractController
{
    #[Route('/offers', name: 'api_offer_list', methods:['GET'])]
    public function offerList(OfferRepository $offerRepository): Response
    {
        $offers = $offerRepository->findAll();

        return $this->json($offers, context:[
            'groups' => ['offers_read']
        ]);
    }

    #[Route('/offers/{id}', name:'api_offer_item', methods:['GET'])]
    public function offerItem(OfferRepository $offerRepository, int $id): Response
    {
        $offer = $offerRepository->find($id);

        return $this->json($offer, context:[
            'groups' => ['offers_read']
        ]);
    }

    #[Route('/location', name:'api_location_list', methods:['GET'])]
    public function locationList(LocationRepository $locationRepository): Response
    {
        $location = $locationRepository->findAll();

        return $this->json($location, context:[
            'groups' => ['location_read']
        ]);
    }
}
