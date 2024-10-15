<?php

namespace App\Entity;

use App\Repository\CasierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Compartiments>
     */
    #[ORM\OneToMany(targetEntity: Compartiments::class, mappedBy: 'leCasier')]
    private Collection $lesCompartiments;

    public function __construct()
    {
        $this->lesCompartiments = new ArrayCollection();
    }

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
    /**
     * @return Collection<int, Compartiments>
     */
    public function getLesCompartiments(): Collection
    {
        return $this->lesCompartiments;
    }

    public function addLesCompartiment(Compartiments $lesCompartiment): static
    {
        if (!$this->lesCompartiments->contains($lesCompartiment)) {
            $this->lesCompartiments->add($lesCompartiment);
            $lesCompartiment->setLeCasier($this);
        }

        return $this;
    }

    public function removeLesCompartiment(Compartiments $lesCompartiment): static
    {
        if ($this->lesCompartiments->removeElement($lesCompartiment)) {
            // set the owning side to null (unless already changed)
            if ($lesCompartiment->getLeCasier() === $this) {
                $lesCompartiment->setLeCasier(null);
            }
        }

        return $this;
    }

    public function setLesCompartimentsParCasier(Casier $leCasier) : array
    {
        $tabCasier= [];
        foreach ($this->getLesCompartiments() as $compartiments) 
        {
            for ($i = 0; $i < 3; $i++) {
                $ligne = [];
                for ($j = 0; $j < 3; $j++) {
                    $compartiments = new Compartiments();
                    $ligne[] = $compartiments;  // Ajouter un compartiment dans la ligne
                }
                $tabCasier = $ligne;  // Ajouter la ligne dans le casier
            }
        }
        return $tabCasier;
    }
}
