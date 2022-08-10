<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\FieldResult;
use SebastianBergmann\Type\TypeName;

#[ORM\Entity(repositoryClass: AnnonceRepository::class)]
class Annonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $create_at = null;

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    private ?Categories $category = null;

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    private ?Deal $deal = null;

    #[ORM\OneToMany(mappedBy: 'annonce_id', targetEntity: Message::class)]
    private Collection $messages;

    #[ORM\OneToMany(mappedBy: 'annonce_id', targetEntity: MessageChat::class)]
    private Collection $messageChats;

    #[ORM\OneToMany(mappedBy: 'annonce', targetEntity: Messages::class, orphanRemoval: true)]
    private Collection $annonce;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->messageChats = new ArrayCollection();
        $this->annonce = new ArrayCollection();
        $this->created_at = new \DateTime();
    }
    public function __toString() 
    {
        return $this->getName();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeInterface $create_at): self
    {
        $this->create_at = $create_at;

        return $this;
    }

    public function getCategory(): ?categories
    {
        return $this->category;
    }

    public function setCategory(?categories $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDeal(): ?deal
    {
        return $this->deal;
    }

    public function setDeal(?deal $deal): self
    {
        $this->deal = $deal;

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setAnnonceId($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getAnnonceId() === $this) {
                $message->setAnnonceId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MessageChat>
     */
    public function getMessageChats(): Collection
    {
        return $this->messageChats;
    }

    public function addMessageChat(MessageChat $messageChat): self
    {
        if (!$this->messageChats->contains($messageChat)) {
            $this->messageChats->add($messageChat);
            $messageChat->setAnnonceId($this);
        }

        return $this;
    }

    public function removeMessageChat(MessageChat $messageChat): self
    {
        if ($this->messageChats->removeElement($messageChat)) {
            // set the owning side to null (unless already changed)
            if ($messageChat->getAnnonceId() === $this) {
                $messageChat->setAnnonceId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getAnnonce(): Collection
    {
        return $this->annonce;
    }

    public function addAnnonce(Messages $annonce): self
    {
        if (!$this->annonce->contains($annonce)) {
            $this->annonce->add($annonce);
            $annonce->setAnnonce($this);
        }

        return $this;
    }

    public function removeAnnonce(Messages $annonce): self
    {
        if ($this->annonce->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getAnnonce() === $this) {
                $annonce->setAnnonce(null);
            }
        }

        return $this;
    }
}
