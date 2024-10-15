<?php

namespace App\Entity;

use App\Repository\ColisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColisRepository::class)]
class Colis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Compartiments $leCompartiment = null;

    #[ORM\ManyToOne(inversedBy: 'lesColis')]
    private ?Ville $laVille = null;

    #[ORM\ManyToOne]
    private ?Taille $laTaille = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeCompartiment(): ?Compartiments
    {
        return $this->leCompartiment;
    }

    public function setLeCompartiment(?Compartiments $leCompartiment): static
    {
        $this->leCompartiment = $leCompartiment;

        return $this;
    }

    public function getLaVille(): ?Ville
    {
        return $this->laVille;
    }

    public function setLaVille(?Ville $laVille): static
    {
        $this->laVille = $laVille;

        return $this;
    }

    public function getLaTaille(): ?Taille
    {
        return $this->laTaille;
    }

    public function setLaTaille(?Taille $laTaille): static
    {
        $this->laTaille = $laTaille;

        return $this;
    }
}
