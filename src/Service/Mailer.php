<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class Mailer
{
    public MailerInterface $mailer;
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendDeleteMessage(User $user)
    {
        $email = (new Email())
            ->from('monelcocou@gmail.com')
            ->to($user->getEmail())
            ->subject('Suppression de produit')
            ->html('<h1> Bienvenue sur E-Market </h1>');

        $this->mailer->send($email);
    }



}