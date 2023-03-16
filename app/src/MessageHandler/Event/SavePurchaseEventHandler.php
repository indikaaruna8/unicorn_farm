<?php

namespace App\MessageHandler\Event;

use App\Message\Event\SavePurchaseEvent;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class SavePurchaseEventHandler implements MessageHandlerInterface
{
    public function __construct(
        private MailerInterface $mailer,
        private string $mailFrom,
    )
    {

    }

    public function __invoke(SavePurchaseEvent $event)
    {
        echo "Mail Send1" . PHP_EOL;
        $email = (new TemplatedEmail()) ->from($this->mailFrom)
        ->to('email@example.com')
        ->subject('Congratulations!!! Your purchase success. - ' . (new \DateTime())->format('Y-m-d h:i:s'))
        ->htmlTemplate('emails/congratulating.html.twig')
        ->context([
            'name' => $event->getName(),
            'unicorn_name' => $event->getUniconeName(),
            'no_of_post' => $event->getNoOfPost(),
        ]);
    
        $this->mailer->send($email);
    }
}
