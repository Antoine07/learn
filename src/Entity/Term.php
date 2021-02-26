<?php

namespace App\Entity;

use App\Repository\TermRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TermRepository::class)
 */
class Term
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $sluf;

    /**
     * @ORM\OneToMany(targetEntity=Taxonomy::class, mappedBy="term")
     */
    private $taxonomies;

    public function __construct()
    {
        $this->taxonomies = new ArrayCollection();
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSluf(): ?string
    {
        return $this->sluf;
    }

    public function setSluf(?string $sluf): self
    {
        $this->sluf = $sluf;

        return $this;
    }

    /**
     * @return Collection|Taxonomy[]
     */
    public function getTaxonomies(): Collection
    {
        return $this->taxonomies;
    }

    public function addTaxonomy(Taxonomy $taxonomy): self
    {
        if (!$this->taxonomies->contains($taxonomy)) {
            $this->taxonomies[] = $taxonomy;
            $taxonomy->setTerm($this);
        }

        return $this;
    }

    public function removeTaxonomy(Taxonomy $taxonomy): self
    {
        if ($this->taxonomies->removeElement($taxonomy)) {
            // set the owning side to null (unless already changed)
            if ($taxonomy->getTerm() === $this) {
                $taxonomy->setTerm(null);
            }
        }

        return $this;
    }
}
