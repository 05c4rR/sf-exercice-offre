<?php

namespace App\Controller;

use App\Entity\NewsletterEmail;
use App\Form\NewsletterType;
use App\Newsletter\MailConfirmation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NewsletterController extends AbstractController
{
    #[Route('/newsletter/subscribe', name: 'newsletter_subscribe', methods: ["GET", "POST"])]
    public function newsletterSubscribe(Request $request, EntityManagerInterface $em, MailConfirmation $mailConfirmation):Response
    {
        $newsletter = new NewsletterEmail;
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($newsletter);
            $em->flush();

            $mailConfirmation->send($newsletter);

            return $this->redirectToRoute('newsletter_success');
        }

        return $this->render('index/newsletter.html.twig', [
            'controller_name' => 'Newsletter',
            'page_name'       => 'Newsletter',
            'form'            => $form,
        ]);
    }

    #[Route('/newsletter/success', name:'newsletter_success')]
    public function newsletterSuccess():Response
    {
        return $this->render('index/newsletter_success.html.twig', [
            'controller_name' => 'Newsletter',
            'page_name'       => 'Newsletter',
        ]);
    }
}
