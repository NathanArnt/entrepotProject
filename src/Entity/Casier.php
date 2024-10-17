<?php

namespace App\Entity;

use App\Repository\CasierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
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
    #[ORM\OneToMany(targetEntity: Compartiments::class, mappedBy: 'leCasier', cascade: ['persist'])]
    private Collection $lesCompartiments;

    public function __construct()
    {
        $this->lesCompartiments = new ArrayCollection();
        $this->setLesCompartimentsParCasier();
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

    public function setLesCompartimentsParCasier() : array
    {
        $tabCasier = [];  // Tableau pour stocker les lignes de compartiments

        // Boucle pour créer 9 compartiments (3 lignes de 3 compartiments chacun)
        for ($i = 0; $i < 3; $i++) {
            $ligne = [];  // Ligne de compartiments
            for ($j = 0; $j < 3; $j++) {
                $compartiment = new Compartiments();  // Créer un nouveau compartiment
                $compartiment->setLeCasier($this);  // Associer le compartiment au casier
                $this->lesCompartiments->add($compartiment);  // Ajouter à la collection de l'entité Casier
                $ligne[] = $compartiment;  // Ajouter le compartiment à la ligne
            }
        $tabCasier[] = $ligne;  // Ajouter la ligne de compartiments dans le tableau final
        }

    return $tabCasier;  // Retourner le tableau des compartiments en grille 3x3
}
}

