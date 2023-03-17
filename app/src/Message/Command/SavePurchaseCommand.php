<?php

namespace App\Message\Command;

use App\Entity\Purchase;
use Doctrine\Common\Collections\Collection;

class SavePurchaseCommand
{
    public function __construct(
        private Purchase $purchase,
        private Collection  $posts
    ) {
    }

    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function getPurchase(): Purchase
    {
        return $this->purchase;
    }
}
