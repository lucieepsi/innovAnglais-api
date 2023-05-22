<?php

namespace App\Entity;

use App\Repository\WordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


#[ApiResource(
    normalizationContext:['groups' => ['read']],
    security: "is_granted('ROLE_USER')"
    )]
#[ORM\Entity(repositoryClass: WordRepository::class)]

#[ORM\Table(name:"Words")]
class Word
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(["read"])]
    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[Groups(["read"])]
    #[ORM\Column(length: 255)]
    private ?string $translation = null;

    #[ORM\ManyToMany(targetEntity: ListWords::class, mappedBy: 'words')]
    private Collection $listWords;

    #[Groups(["read"])]
    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'words')]
    private Collection $category;

    public function __construct()
    {
        $this->listWords = new ArrayCollection();
        $this->category = new ArrayCollection();
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

    public function getTranslation(): ?string
    {
        return $this->translation;
    }

    public function setTranslation(string $translation): self
    {
        $this->translation = $translation;

        return $this;
    }

    /**
     * @return Collection<int, ListWords>
     */
    public function getListWords(): Collection
    {
        return $this->listWords;
    }

    public function addListWord(ListWords $listWord): self
    {
        if (!$this->listWords->contains($listWord)) {
            $this->listWords->add($listWord);
            $listWord->addWord($this);
        }

        return $this;
    }

    public function removeListWord(ListWords $listWord): self
    {
        if ($this->listWords->removeElement($listWord)) {
            $listWord->removeWord($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }
}
