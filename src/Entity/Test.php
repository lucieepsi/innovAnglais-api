<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;


#[ORM\Entity(repositoryClass: TestRepository::class)]
#[ApiResource]
#[ORM\Table(name:"Tests")]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column]
    private ?float $level = null;

    #[ORM\ManyToOne(inversedBy: 'tests')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Module $module = null;

    #[ORM\OneToMany(mappedBy: 'test', targetEntity: Attempt::class)]
    private Collection $attempts;

    #[ORM\ManyToMany(targetEntity: ListWords::class)]
    private Collection $lists;

    public function __construct()
    {
        $this->attempts = new ArrayCollection();
        $this->lists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getLevel(): ?float
    {
        return $this->level;
    }

    public function setLevel(float $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): self
    {
        $this->module = $module;

        return $this;
    }

    /**
     * @return Collection<int, Attempt>
     */
    public function getAttempts(): Collection
    {
        return $this->attempts;
    }

    public function addAttempt(Attempt $attempt): self
    {
        if (!$this->attempts->contains($attempt)) {
            $this->attempts->add($attempt);
            $attempt->setTest($this);
        }

        return $this;
    }

    public function removeAttempt(Attempt $attempt): self
    {
        if ($this->attempts->removeElement($attempt)) {
            // set the owning side to null (unless already changed)
            if ($attempt->getTest() === $this) {
                $attempt->setTest(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ListWords>
     */
    public function getLists(): Collection
    {
        return $this->lists;
    }

    public function addList(ListWords $list): self
    {
        if (!$this->lists->contains($list)) {
            $this->lists->add($list);
        }

        return $this;
    }

    public function removeList(ListWords $list): self
    {
        $this->lists->removeElement($list);

        return $this;
    }
}
