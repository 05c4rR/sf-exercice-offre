<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\LocationRepository;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OfferCollectionController extends AbstractController
{
    #[Route('/offer/collection/{id}', name: 'offer_collection')]
    public function index(Location $locationName, OfferRepository $offerRepository, LocationRepository $locationRepository, int $id): Response
    {   
        $location = $locationRepository->findBy(['id' => $id]);
        $offers = $offerRepository->findBy(['location'=>$id]);

        return $this->render('offer_collection/index.html.twig', [
            'controller_name' => 'Offres à '.$locationName->getName(),
            'page_name'       => 'Nos offres à ...',
            'location'        => $location,
            'offers'          => $offers,
        ]);
    }
}
