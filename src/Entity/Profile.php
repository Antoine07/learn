<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfileRepository::class)
 */
class Profile
{
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
     * @ORM\Column(type="string", length=100)
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="profile", cascade={"persist", "remove"})
     */
    private $user_profile;

    /**
     * @ORM\OneToOne(targetEntity=Template::class, inversedBy="profile", cascade={"persist", "remove"})
     */
    private $template;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number_lessons;

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

    public function getUserProfile(): ?User
    {
        return $this->user_profile;
    }

    public function setUserProfile(?User $user_profile): self
    {
        // unset the owning side of the relation if necessary
        if ($user_profile === null && $this->user_profile !== null) {
            $this->user_profile->setProfile(null);
        }

        // set the owning side of the relation if necessary
        if ($user_profile !== null && $user_profile->getProfile() !== $this) {
            $user_profile->setProfile($this);
        }

        $this->user_profile = $user_profile;

        return $this;
    }

    public function getTemplate(): ?Template
    {
        return $this->template;
    }

    public function setTemplate(?Template $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function getNumberLessons(): ?int
    {
        return $this->number_lessons;
    }

    public function setNumberLessons(?int $number_lessons): self
    {
        $this->number_lessons = $number_lessons;

        return $this;
    }
}
