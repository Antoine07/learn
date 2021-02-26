<?php

namespace App\Entity;

use App\Repository\SubscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubscriptionRepository::class)
 */
class Subscription
{
    const STATUS = ['one_day', 'two_days', 'week', 'every_time'];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Ticket::class, mappedBy="subscription")
     */
    private $tikets;

    public function __construct()
    {
        $this->tikets = new ArrayCollection();
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        if (!in_array($status, self::STATUS) ) {
            throw new \InvalidArgumentException("Invalid status");
        }

        $this->status = $status;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTikets(): Collection
    {
        return $this->tikets;
    }

    public function addTiket(Ticket $tiket): self
    {
        if (!$this->tikets->contains($tiket)) {
            $this->tikets[] = $tiket;
            $tiket->setSubscription($this);
        }

        return $this;
    }

    public function removeTiket(Ticket $tiket): self
    {
        if ($this->tikets->removeElement($tiket)) {
            // set the owning side to null (unless already changed)
            if ($tiket->getSubscription() === $this) {
                $tiket->setSubscription(null);
            }
        }

        return $this;
    }
}
