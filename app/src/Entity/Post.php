<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ApiResource(
    // operations: [
    //     new ApiPost(messenger: true, output: true, status: 201)
    // ],
    normalizationContext: ['groups' => ['post.read']],
    denormalizationContext: ['groups' => ['post.write']],
)]
#[ApiFilter(SearchFilter::class, properties: [
    'unicornEnthusiast.email' => SearchFilter::STRATEGY_EXACT,
    'unicorn.name' => 'partial',
])]
#[ORM\HasLifecycleCallbacks]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    #[Groups(['post.read', 'post.write'])]
    #[Assert\Length(
        min: 50,
        max: 400,
        minMessage: 'Message must be at least {{ limit }} characters long',
        maxMessage: 'Message cannot be longer than {{ limit }} characters',
    )]
    private ?string $message = null;

    #[ORM\Column]
    #[Groups('post.read')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Groups('post.read')]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[Groups(['post.read', 'post.write'])]
    #[ApiFilter(SearchFilter::class, strategy: 'exact')]
    private ?Unicorn $unicorn = null;

    #[ORM\ManyToOne(inversedBy: 'post', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['post.read', 'post.write'])]
    #[Assert\NotBlank]
    private ?UnicornEnthusiast $unicornEnthusiast = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getUnicorn(): ?Unicorn
    {
        return $this->unicorn;
    }

    public function setUnicorn(?Unicorn $unicorn): self
    {
        $this->unicorn = $unicorn;

        return $this;
    }

    public function getUnicornEnthusiast(): ?UnicornEnthusiast
    {
        return $this->unicornEnthusiast;
    }

    public function setUnicornEnthusiast(?UnicornEnthusiast $unicornEnthusiast): self
    {
        $this->unicornEnthusiast = $unicornEnthusiast;

        return $this;
    }
}
