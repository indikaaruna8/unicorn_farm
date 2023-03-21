<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\UnicornRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UnicornRepository::class)]
#[
    ApiResource(
        normalizationContext: ['groups' => ['unicorn.read']],
        paginationItemsPerPage: 50,
        operations: [
            new GetCollection()
        ]
    )
]
#[ApiFilter(OrderFilter::class, properties: ['name'], arguments: ['orderParameterName' => 'order'])]
class Unicorn
{
    public const GENDER_FEMALE = 'f';
    public const GENDER_MALE = 'm';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups('unicorn.read')]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups('unicorn.read')]
    #[ORM\Column(length: 1)]
    private ?string $gender = null;

    #[Groups('unicorn.read')]
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $birthAt = null;

    #[Groups('unicorn.read')]
    #[ORM\Column(length: 200)]
    private ?string $image = null;

    #[Groups('unicorn.read')]
    #[ORM\Column(nullable: true)]
    private ?float $averageHeight = null;

    #[Groups('unicorn.read')]
    #[ORM\Column(nullable: true)]
    private ?float $averageWidth = null;

    #[ORM\Column(nullable: true)]
    #[Groups('unicorn.read')]
    private ?float $avarageWeight = null;

    #[Groups('unicorn.read')]
    #[ORM\Column(length: 20, nullable: true)]
    private ?string $hairColor = null;

    #[Groups('unicorn.read')]
    #[ORM\Column(length: 20, nullable: true)]
    private ?string $eyeColor = null;

    #[Groups('unicorn.read')]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'unicorn', targetEntity: Post::class)]
    private Collection $posts;

    #[Groups('unicorn.read')]
    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'childsOfMother')]
    private ?self $mother = null;

    #[ORM\OneToMany(mappedBy: 'mother', targetEntity: self::class)]
    private Collection $childsOfMother;

    #[Groups('unicorn.read')]
    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'childsOfFather')]
    private ?self $father = null;


    #[ORM\OneToMany(mappedBy: 'father', targetEntity: self::class)]
    private Collection $childsOfFather;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->childsOfMother = new ArrayCollection();
        $this->childsOfFather = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBirthAt(): ?\DateTimeImmutable
    {
        return $this->birthAt;
    }

    public function setBirthAt(?\DateTimeImmutable $birthAt): self
    {
        $this->birthAt = $birthAt;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getAverageHeight(): ?float
    {
        return $this->averageHeight;
    }

    public function setAverageHeight(?float $averageHeight): self
    {
        $this->averageHeight = $averageHeight;

        return $this;
    }

    public function getAverageWidth(): ?float
    {
        return $this->averageWidth;
    }

    public function setAverageWidth(?float $averageWidth): self
    {
        $this->averageWidth = $averageWidth;

        return $this;
    }

    public function getAvarageWeight(): ?float
    {
        return $this->avarageWeight;
    }

    public function setAvarageWeight(?float $avarageWeight): self
    {
        $this->avarageWeight = $avarageWeight;

        return $this;
    }

    public function getHairColor(): ?string
    {
        return $this->hairColor;
    }

    public function setHairColor(?string $hairColor): self
    {
        $this->hairColor = $hairColor;

        return $this;
    }

    public function getEyeColor(): ?string
    {
        return $this->eyeColor;
    }

    public function setEyeColor(?string $eyeColor): self
    {
        $this->eyeColor = $eyeColor;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setUnicorn($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUnicorn() === $this) {
                $post->setUnicorn(null);
            }
        }

        return $this;
    }

    public function getMother(): ?self
    {
        return $this->mother;
    }

    public function setMother(?self $mother): self
    {
        $this->mother = $mother;

        return $this;
    }

    /**
     * @return Collection<int, Unicorn>
     */
    public function getChildsOfMother(): Collection
    {
        return $this->childsOfMother;
    }

    public function addChildsOfMother(Unicorn $childsOfMother): self
    {
        if (!$this->childsOfMother->contains($childsOfMother)) {
            $this->childsOfMother->add($childsOfMother);
            $childsOfMother->setMother($this);
        }

        return $this;
    }

    public function removeChildsOfMother(Unicorn $childsOfMother): self
    {
        if ($this->childsOfMother->removeElement($childsOfMother)) {
            // set the owning side to null (unless already changed)
            if ($childsOfMother->getMother() === $this) {
                $childsOfMother->setMother(null);
            }
        }

        return $this;
    }

    public function getFather(): ?self
    {
        return $this->father;
    }

    public function setFather(?self $father): self
    {
        $this->father = $father;

        return $this;
    }

    /**
     * @return Collection<int, Unicorn>
     */
    public function getChildsOfFather(): Collection
    {
        return $this->childsOfFather;
    }

    public function addChildsOfFather(Unicorn $childsOfFather): self
    {
        if (!$this->childsOfFather->contains($childsOfFather)) {
            $this->childsOfFather->add($childsOfFather);
            $childsOfFather->setFather($this);
        }

        return $this;
    }

    public function removeChildsOfFather(Unicorn $childsOfFather): self
    {
        if ($this->childsOfFather->removeElement($childsOfFather)) {
            // set the owning side to null (unless already changed)
            if ($childsOfFather->getFather() === $this) {
                $childsOfFather->setFather(null);
            }
        }

        return $this;
    }
}
