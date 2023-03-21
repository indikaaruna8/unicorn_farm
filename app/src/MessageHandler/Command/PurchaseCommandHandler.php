<?php

namespace App\MessageHandler\Command;

use App\Exception\DatabaseTransactionException;
use App\Message\Command\PurchaseCommand;
use App\Message\Event\PurchaseNotificationEvent;
use App\Repository\PostRepository;
use App\Repository\PurchaseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * This command will save the order and delete all the post related to any unicorn.
 */
#[AsMessageHandler()]
class PurchaseCommandHandler
{
    public function __construct(
        private MessageBusInterface $eventBus,
        private PurchaseRepository $purchaseRepository,
        private  EntityManagerInterface $em,
        private PostRepository $postRepository
    ) {
    }

    public function __invoke(PurchaseCommand $purchase)
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

        $this->eventBus->dispatch(new PurchaseNotificationEvent($purchase->getPurchase()));
    }
}
