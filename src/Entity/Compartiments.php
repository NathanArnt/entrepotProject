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

    #[ORM\ManyToOne]
    private ?Statut $leStatut = null;

    #[ORM\ManyToOne(inversedBy: 'lesCompartiments')]
    private ?Casier $leCasier = null;

    #[ORM\ManyToOne(inversedBy: 'lesCompartiments')]
    private ?Colis $leColis = null;

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

    public function getLeCasier(): ?Casier
    {
        return $this->leCasier;
    }

    public function setLeCasier(?Casier $leCasier): static
    {
        $this->leCasier = $leCasier;

        return $this;
    }

    public function getLeColis(): ?Colis
    {
        return $this->leColis;
    }

    public function setLeColis(?Colis $leColis): static
    {
        $this->leColis = $leColis;

        return $this;
    }
}
