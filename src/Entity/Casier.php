<?php

namespace App\Entity;

use App\Repository\CasierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CasierRepository::class)]
class Casier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Statut $leStatut = null;

    #[ORM\ManyToOne(inversedBy: 'lesCasiers')]
    private ?Entrepot $leEntrepot = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeStatut(): ?Statut
    {
        return $this->leStatut;
    }

    public function setLeStatut(?Statut $leStatut): static
    {
        $this->leStatut = $leStatut;

        return $this;
    }

    public function getLeEntrepot(): ?Entrepot
    {
        return $this->leEntrepot;
    }

    public function setLeEntrepot(?Entrepot $leEntrepot): static
    {
        $this->leEntrepot = $leEntrepot;

        return $this;
    }
}
