<?php

namespace App\Message\Event;

use App\Entity\Purchase;
use Doctrine\Common\Collections\Collection;

class SavePurchaseEvent
{
    public function __construct(
        private Purchase $purchase,
    ) {
    }

    public function getName(): ?string
    {
        return $this->purchase->getUnicornEnthusiastId();
    }

    public function getEmail(): ?string
    {
        return $this->purchase->getEmail();
    }

    public function getUniconeName(): ?string
    {
        return $this->purchase->getUnicornName();
    }

    public function getNoOfPost(): ?int
    {
        return $this->purchase->getNoOfPost();
    }

    public function getPost(): Collection
    {
        return $this->posts;
    }
}
