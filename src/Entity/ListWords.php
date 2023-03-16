<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ListWordsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListWordsRepository::class)]
#[ApiResource]
#[ORM\Table(name:"ListsWords")]
class ListWords
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\ManyToOne(inversedBy: 'listsWords')]
    private ?Theme $theme = null;

    #[ORM\ManyToMany(targetEntity: Word::class, inversedBy: 'listWords')]
    private Collection $words;

    public function __construct()
    {
        $this->words = new ArrayCollection();
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

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * @return Collection<int, Word>
     */
    public function getWords(): Collection
    {
        return $this->words;
    }

    public function addWord(Word $word): self
    {
        if (!$this->words->contains($word)) {
            $this->words->add($word);
        }

        return $this;
    }

    public function removeWord(Word $word): self
    {
        $this->words->removeElement($word);

        return $this;
    }
}
