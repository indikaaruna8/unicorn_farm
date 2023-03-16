<?php

namespace App\MessageHandler\Command;

use App\Message\Command\SaveOrder;
use App\Message\Event\OrderSavedEvent;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Summary of SaveOrderHandler
 */
class SaveOrderHandler implements MessageHandlerInterface
{

    public function __construct(private MessageBusInterface $eventBus)
    {

    }

    public function __invoke(SaveOrder $saveOrder)
    {
        echo "order being saved.";
        $this->eventBus->dispatch(new OrderSavedEvent());
    }

}
