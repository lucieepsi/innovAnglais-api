<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: ThemeRepository::class)]
#[ApiResource(normalizationContext:['groups' => ['read']])]
#[ORM\Table(name:"Themes")]
class Theme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(["read"])]
    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\OneToMany(mappedBy: 'theme', targetEntity: ListWords::class)]
    private Collection $listsWords;

    public function __construct()
    {
        $this->listsWords = new ArrayCollection();
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

    /**
     * @return Collection<int, ListWords>
     */
    public function getListsWords(): Collection
    {
        return $this->listsWords;
    }

    public function addListsWord(ListWords $listsWord): self
    {
        if (!$this->listsWords->contains($listsWord)) {
            $this->listsWords->add($listsWord);
            $listsWord->setTheme($this);
        }

        return $this;
    }

    public function removeListsWord(ListWords $listsWord): self
    {
        if ($this->listsWords->removeElement($listsWord)) {
            // set the owning side to null (unless already changed)
            if ($listsWord->getTheme() === $this) {
                $listsWord->setTheme(null);
            }
        }

        return $this;
    }
}
