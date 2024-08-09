<?php

namespace App\Controller;

use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OfferDetailController extends AbstractController
{
    #[Route('/offer/detail/{id}', name: 'offer_detail')]
    public function index(OfferRepository $offerRepository, int $id): Response
    {   
        $offer = $offerRepository->find($id);

        return $this->render('offer_detail/index.html.twig', [
            'controller_name' => 'Offre pour - '.$offer->getTitle(),
            'offer'           => $offer,    
        ]);
    }
}
