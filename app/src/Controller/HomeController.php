<?php

namespace App\Controller;

use App\Message\Command\SaveOrder;
use App\Message\EmailNotification;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/mail', name: 'app_mail')]
    public function mail(MessageBusInterface $bus): Response
    {
       //  $bus->dispatch(new EmailNotification('Look! I created a message!'));
         $bus->dispatch(new SaveOrder());
        //$mailer->send($email);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
