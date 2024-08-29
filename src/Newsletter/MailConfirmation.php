<?php

namespace App\Newsletter;

use App\Entity\NewsletterEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailConfirmation
{
    public function __construct(
        private MailerInterface $mailer,
        private string $adminEmail
    ) {

    }

    public function send(NewsletterEmail $newsletterEmail)
    {
        $email = (new Email())
        ->from($this->adminEmail)
        ->to($newsletterEmail->getEmail())
        ->subject('Email envoyé par Symfony!')
        ->text('C\'est assez stylé en vrai!')
        ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($email);
    }
}