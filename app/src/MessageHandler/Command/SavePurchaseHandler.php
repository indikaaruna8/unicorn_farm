<?php

namespace App\MessageHandler\Command;

use App\Exception\DatabaseTransactionException;
use App\Message\Command\SavePurchaseCommand;
use App\Message\Event\SavePurchaseEvent;
use App\Repository\PostRepository;
use App\Repository\PurchaseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class SavePurchaseHandler implements MessageHandlerInterface
{
    public function __construct(
        private MessageBusInterface $eventBus,
        private PurchaseRepository $purchaseRepository,
        private  EntityManagerInterface $em,
        private PostRepository $postRepository
    ) {
    }

    public function __invoke(SavePurchaseCommand $purchase)
    {
        $this->em->beginTransaction();
        try {
            foreach ($purchase->getPosts() as $post) {
                $this->postRepository->remove($post);
            }
            $this->purchaseRepository->save($purchase->getPurchase());
            $this->em->flush();
            $this->em->commit();
        } catch (\Exception $ex) {
            $this->em->rollback();
            throw  new DatabaseTransactionException("Internal database transaction error.", 1001, $ex);
        }

        $this->eventBus->dispatch(new SavePurchaseEvent($purchase->getPurchase()));
    }
}
