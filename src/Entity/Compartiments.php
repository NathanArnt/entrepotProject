<?php

namespace App\Entity;

use App\Repository\CompartimentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompartimentsRepository::class)]
class Compartiments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $statut = null;

    #[ORM\ManyToOne]
    private ?Casier $leCasier = null;

    #[ORM\Column(length: 50)]
    private ?string $capacite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getLeCasier(): ?Casier
    {
        return $this->leCasier;
    }

    public function setLeCasier(?Casier $leCasier): static
    {
        $this->leCasier = $leCasier;

        return $this;
    }

    public function getCapacite(): ?string
    {
        return $this->capacite;
    }

    public function setCapacite(string $capacite): static
    {
        $this->capacite = $capacite;

        return $this;
    }
}
