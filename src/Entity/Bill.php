<?php

namespace App\Entity;

use App\Repository\BillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BillRepository::class)
 */
class Bill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $number;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\ManyToMany(targetEntity=Lesson::class, inversedBy="bills")
     */
    private $lessons;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="bills", cascade={"persist"})
     */
    private $user_bill;

    public function __construct()
    {
        $this->lessons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection|Lesson[]
     */
    public function getLessons(): Collection
    {
        return $this->lessons;
    }

    public function addLesson(Lesson $lesson): self
    {
        if (!$this->lessons->contains($lesson)) {
            $this->lessons[] = $lesson;
        }

        return $this;
    }

    public function removeLesson(Lesson $lesson): self
    {
        $this->lessons->removeElement($lesson);

        return $this;
    }

    public function getUserBill(): ?User
    {
        return $this->user_bill;
    }

    public function setUserBill(?User $user_bill): self
    {
        $this->user_bill = $user_bill;

        return $this;
    }
}
