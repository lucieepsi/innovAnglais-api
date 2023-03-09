<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AttemptRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttemptRepository::class)]
#[ApiResource]
#[ORM\Table(name:"Attempts")]
class Attempt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateAttempt = null;

    #[ORM\Column]
    private ?float $score = null;

    #[ORM\ManyToOne(inversedBy: 'attempts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'attempts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Test $test = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAttempt(): ?\DateTimeInterface
    {
        return $this->dateAttempt;
    }

    public function setDateAttempt(\DateTimeInterface $dateAttempt): self
    {
        $this->dateAttempt = $dateAttempt;

        return $this;
    }

    public function getScore(): ?float
    {
        return $this->score;
    }

    public function setScore(float $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTest(): ?Test
    {
        return $this->test;
    }

    public function setTest(?Test $test): self
    {
        $this->test = $test;

        return $this;
    }
}