<?php

namespace App\Entity;

use App\Repository\CasierRepository;
use App\Repository\StatutRepository;
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

    public function peutAjouterColis(Colis $colis,StatutRepository $statutRepository): bool
    {
    // Récupérer le nombre de compartiments requis pour le colis
    $nombreCompartimentsRequis = $colis->getNombreCompartimentsRequis();
    
    // Diviser les compartiments en lignes (3 lignes de 3 compartiments)
    $compartimentsParLigne = array_chunk($this->lesCompartiments->toArray(), 3);

    // Parcourir les lignes du casier
    foreach ($compartimentsParLigne as $ligne) {
        $compartimentsLibresSurLigne = [];

        // Vérifier si chaque compartiment de la ligne est vide
        foreach ($ligne as $compartiment) {
            if ($compartiment->getLeColis() === null) {  // Vérifie si le compartiment est libre
                $compartimentsLibresSurLigne[] = $compartiment;
            }

            // Si on trouve suffisamment de compartiments vides dans la ligne actuelle
            if (count($compartimentsLibresSurLigne) === $nombreCompartimentsRequis) {
                // Associer les compartiments au colis
                foreach ($compartimentsLibresSurLigne as $compartimentLibre) {
                    $compartimentLibre->setLeColis($colis);
                    $compartimentLibre->setLeStatut('rempli');  // Mettre à jour le statut à "occupé"
                }
                return true;  // Colis ajouté avec succès
            }
        }
    }

    // Si aucune ligne n'a pu accueillir le colis, on marque le casier comme rempli
    $statutRempli = $statutRepository->findOneBy(['libelle' => 'rempli']);
    if ($statutRempli) {
        $this->setLeStatut($statutRempli);
    }
    
    return false;  // Casier plein, le colis ne peut pas être ajouté
    }
}

