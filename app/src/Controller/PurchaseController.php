<?php

namespace App\Controller;

use App\Entity\Post;
use App\Message\Command\SavePurchaseCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class PurchaseController extends AbstractController
{

    #[Route(
        name: 'path_purchase',
        path: '/api/purchase',
        methods: ['POST'],
        defaults: [
            '_api_resource_class' => Post::class,
        ],
    )]
    public function __invoke(MessageBusInterface $bus, Request $request): Response 
    {
        $bus->dispatch(new SavePurchaseCommand());
       return $this->json(['property'=> $_POST],202);
    }
}
