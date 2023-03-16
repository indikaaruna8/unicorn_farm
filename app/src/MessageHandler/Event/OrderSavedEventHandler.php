<?php

namespace App\MessageHandler\Event;

use App\Message\Event\OrderSavedEvent;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class OrderSavedEventHandler implements MessageHandlerInterface
{
    public function __construct(
        private MailerInterface $mailer,
        private string $mailFrom,
    )
    {

    }

    public function __invoke(OrderSavedEvent $event)
    {
        echo "ddd";
        $email = (new TemplatedEmail()) ->from($this->mailFrom)
        ->to('email@example.com')
        ->subject('email@example.com')
        ->htmlTemplate('emails/congratulating.html.twig')
        ->context([
            'name' => $event->getName(),
            'unicorn_name' => 'xxx',
            'no_of_post' => 10,
        ]);
    
        $this->mailer->send($email);
    }
}
