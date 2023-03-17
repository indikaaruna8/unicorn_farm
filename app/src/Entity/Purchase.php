<?php

namespace App\Entity;

use App\Repository\PurchaseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PurchaseRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Purchase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $unicornName = null;

    #[ORM\Column]
    private ?int $unicornId = null;

    #[ORM\Column(length: 255)]
    private ?string $unicornEnthusiastName = null;

    #[ORM\Column]
    private ?int $unicornEnthusiastId = null;

    #[ORM\Column]
    private ?int $noOfPost = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnicornName(): ?string
    {
        return $this->unicornName;
    }

    public function setUnicornName(string $unicornName): self
    {
        $this->unicornName = $unicornName;

        return $this;
    }

    public function getUnicornId(): ?int
    {
        return $this->unicornId;
    }

    public function setUnicornId(int $unicornId): self
    {
        $this->unicornId = $unicornId;

        return $this;
    }

    public function getUnicornEnthusiastName(): ?string
    {
        return $this->unicornEnthusiastName;
    }

    public function setUnicornEnthusiastName(string $unicornEnthusiastName): self
    {
        $this->unicornEnthusiastName = $unicornEnthusiastName;

        return $this;
    }

    public function getUnicornEnthusiastId(): ?int
    {
        return $this->unicornEnthusiastId;
    }

    public function setUnicornEnthusiastId(int $unicornEnthusiastId): self
    {
        $this->unicornEnthusiastId = $unicornEnthusiastId;

        return $this;
    }

    public function getNoOfPost(): ?int
    {
        return $this->noOfPost;
    }

    public function setNoOfPost(int $noOfPost): self
    {
        $this->noOfPost = $noOfPost;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
