<?php

namespace App\MessageHandler\Command;

use App\Message\Command\SavePurchaseCommand;
use App\Message\Event\SavePurchaseEvent;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class SavePurchaseHandler implements MessageHandlerInterface
{
    public function __construct(private MessageBusInterface $eventBus)
    {

    }

    public function __invoke(SavePurchaseCommand $purchase)
    {
        echo "Deleting posts";
        $this->eventBus->dispatch(new SavePurchaseEvent());
    }
}
