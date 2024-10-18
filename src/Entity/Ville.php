<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Colis>
     */
    #[ORM\OneToMany(targetEntity: Colis::class, mappedBy: 'laVille')]
    private Collection $lesColis;


    public function __construct()
    {
        $this->lesColis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Colis>
     */
    public function getLesColis(): Collection
    {
        return $this->lesColis;
    }

    public function addLesColis(Colis $lesColis): static
    {
        if (!$this->lesColis->contains($lesColis)) {
            $this->lesColis->add($lesColis);
            $lesColis->setLaVille($this);
        }

        return $this;
    }

    public function removeLesColis(Colis $lesColis): static
    {
        if ($this->lesColis->removeElement($lesColis)) {
            // set the owning side to null (unless already changed)
            if ($lesColis->getLaVille() === $this) {
                $lesColis->setLaVille(null);
            }
        }

        return $this;
    }
    
}
