<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user_buy_id = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user_sell_id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $create_at = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Annonce $annonce_id = null;

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

    public function getUserBuyId(): ?Users
    {
        return $this->user_buy_id;
    }

    public function setUserBuyId(?Users $user_buy_id): self
    {
        $this->user_buy_id = $user_buy_id;

        return $this;
    }

    public function getUserSellId(): ?Users
    {
        return $this->user_sell_id;
    }

    public function setUserSellId(?Users $user_sell_id): self
    {
        $this->user_sell_id = $user_sell_id;

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

    public function getAnnonceId(): ?Annonce
    {
        return $this->annonce_id;
    }

    public function setAnnonceId(?Annonce $annonce_id): self
    {
        $this->annonce_id = $annonce_id;

        return $this;
    }
}
