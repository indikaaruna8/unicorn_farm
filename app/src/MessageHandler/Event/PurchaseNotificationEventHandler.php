<?php

namespace App\MessageHandler\Event;

use App\Message\Event\PurchaseNotificationEvent;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

/**
 * Purchase notification email.
 */
class PurchaseNotificationEventHandler implements MessageHandlerInterface
{
    /**
     * Undocumented function
     *
     * @param MailerInterface $mailer
     * @param string $mailFrom Configured in global variable
     * @param LoggerInterface $log
     * @param EntityManagerInterface $em
     */
    public function __construct(
        private MailerInterface $mailer,
        private string $mailFrom,
        private LoggerInterface $log,
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(PurchaseNotificationEvent $event)
    {
        $email = (new TemplatedEmail())->from($this->mailFrom)
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
