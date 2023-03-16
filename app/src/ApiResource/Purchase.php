<?php

namespace App\ApiResource;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(operations: [
    new Post(
        name: 'purchase',
        uriTemplate: '/api/purchase',
        controller: PurchaseController::class,
        routeName: 'path_purchase',
    )
])]
class Purchase
{
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    private string $unicorn;

    private string  $unicornEnthusiasts;

    /**
     * @return string
     */
    public function getUnicorn(): string
    {
        return $this->unicorn;
    }

    /**
     * @param string $unicorn 
     * @return self
     */
    public function setUnicorn(string $unicorn): self
    {
        $this->unicorn = $unicorn;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnicornEnthusiasts(): string
    {
        return $this->unicornEnthusiasts;
    }

    /**
     * @param string $unicornEnthusiasts 
     * @return self
     */
    public function setUnicornEnthusiasts(string $unicornEnthusiasts): self
    {
        $this->unicornEnthusiasts = $unicornEnthusiasts;
        return $this;
    }
}
