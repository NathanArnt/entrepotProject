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

    #[ORM\Column(length: 50)]
    private ?string $taille = null;

    #[ORM\Column]
    private ?float $poids = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Compartiments $leCompartiment = null;

    #[ORM\ManyToOne(inversedBy: 'lesColis')]
    private ?Ville $laVille = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(float $poids): static
    {
        $this->poids = $poids;

        return $this;
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
}
