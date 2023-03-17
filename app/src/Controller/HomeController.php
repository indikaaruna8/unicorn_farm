<?php

namespace App\Controller;

use App\ApiResource\Purchase;
use App\Form\Type\PurchaseType;
use App\Message\Command\SavePurchaseCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    // #[Route('/mail', name: 'app_mail')]
    // public function mail(MessageBusInterface $bus): Response
    // {
    //    //  $bus->dispatch(new EmailNotification('Look! I created a message!'));
    //      $bus->dispatch(new SavePurchaseCommand());
    //     //$mailer->send($email);
    //     return $this->render('home/index.html.twig', [
    //         'controller_name' => 'HomeController',
    //     ]);
    // }

    // #[Route('/mail2', name: 'app_mail2')]
    // public function mail2(MailerInterface $mail): Response
    // {
    //     $email = (new Email() ) ->to('email@example.com')
    //     ->from("indika@yahoo.com")
    //     ->html("<h1>HI</h1>")
    //     ->subject('email@example.com');

    //     $mail->send($email);
    //    return new Response("xxx");
    // }

    //   #[Route('/mail2', name: 'app_mail2')]
    // public function mail2(MailerInterface $mail): Response
    // {
    //     $purchse = new Purchase();
    //     $form = $this->createForm(PurchaseType::class, $purchse);

    //     return $this->render('home/form.html.twig', [
    //         'form' => $form,
    //     ]);
    // }
}
