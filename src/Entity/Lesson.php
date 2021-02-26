<?php

namespace App\Entity;

use App\Repository\LessonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LessonRepository::class)
 */
class Lesson
{
    const STATUS = ['draft', 'publish', 'future', 'private', 'inherit', 'pending'];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"show_lesson"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"show_lesson"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"show_lesson"})
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"show_lesson"})
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Author::class, inversedBy="lessons")
     * @ORM\JoinTable(name="lesson_author")
     * @Groups({"show_lesson"})
     */
    private $authors;

    /**
     * @ORM\OneToOne(targetEntity=Resource::class, cascade={"persist", "remove"})
     */
    private $resource;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="lesson")
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity=Bill::class, mappedBy="lessons")
     */
    private $bills;

    /**
     * @ORM\ManyToMany(targetEntity=Taxonomy::class, inversedBy="lessons")
     * @ORM\JoinTable(name="lesson_taxonomy")
     * @Groups({"show_lesson"})
     */
    private $taxonomies;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="lesson")
     */
    private $questions;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"show_lesson"})
     */
    private $created_at;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"show_lesson"})
     */
    private $rate;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"show_lesson"})
     */
    private $content;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->bills = new ArrayCollection();
        $this->taxonomies = new ArrayCollection();
        $this->questions = new ArrayCollection();
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

    public function setStatus(string $status): self
    {
        if (!in_array($status, self::STATUS) ) {
            throw new \InvalidArgumentException("Invalid status");
        }

        $this->status = $status;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Author[]
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthor(Author $author): self
    {
        if (!$this->authors->contains($author)) {
            $this->authors[] = $author;
        }

        return $this;
    }

    public function removeAuthor(Author $author): self
    {
        $this->authors->removeElement($author);

        return $this;
    }

    public function getResource(): ?Resource
    {
        return $this->resource;
    }

    public function setResource(?Resource $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setLesson($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getLesson() === $this) {
                $comment->setLesson(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bill[]
     */
    public function getBills(): Collection
    {
        return $this->bills;
    }

    public function addBill(Bill $bill): self
    {
        if (!$this->bills->contains($bill)) {
            $this->bills[] = $bill;
            $bill->addLesson($this);
        }

        return $this;
    }

    public function removeBill(Bill $bill): self
    {
        if ($this->bills->removeElement($bill)) {
            $bill->removeLesson($this);
        }

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
        }

        return $this;
    }

    public function removeTaxonomy(Taxonomy $taxonomy): self
    {
        $this->taxonomies->removeElement($taxonomy);

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setLesson($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getLesson() === $this) {
                $question->setLesson(null);
            }
        }

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

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(?int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
