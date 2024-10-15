<?php

namespace App\Entity;

use Symfony\Component\Form\FormTypeInterface;
use App\Repository\EntrepotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepotRepository::class)]
class Entrepot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $nbrCasier = null;

    /**
     * @var Collection<int, Distance>
     */
    #[ORM\OneToMany(targetEntity: Distance::class, mappedBy: 'leEntrepot')]
    private Collection $lesDistances;


    #[ORM\ManyToOne]
    private ?Statut $leStatut = null;

    /**
     * @var Collection<int, Casier>
     */
    #[ORM\OneToMany(targetEntity: Casier::class, mappedBy: 'leEntrepot')]
    private Collection $lesCasiers;

    public function __construct()
    {
        $this->lesDistances = new ArrayCollection();
        $this->lesCasiers = new ArrayCollection();
        $this->creerCasier();
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

    public function getNbrCasier(): ?int
    {
        return $this->nbrCasier;
    }

    public function setNbrCasier(int $nbrCasier): static
    {
        $this->nbrCasier = $nbrCasier;

        return $this;
    }

    /**
     * @return Collection<int, Distance>
     */
    public function getLesDistances(): Collection
    {
        return $this->lesDistances;
    }

    public function addLesDistance(Distance $lesDistance): static
    {
        if (!$this->lesDistances->contains($lesDistance)) {
            $this->lesDistances->add($lesDistance);
            $lesDistance->setLeEntrepot($this);
        }

        return $this;
    }

    public function removeLesDistance(Distance $lesDistance): static
    {
        if ($this->lesDistances->removeElement($lesDistance)) {
            // set the owning side to null (unless already changed)
            if ($lesDistance->getLeEntrepot() === $this) {
                $lesDistance->setLeEntrepot(null);
            }
        }

        return $this;
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

    /**
     * @return Collection<int, Casier>
     */
    public function getLesCasiers(): Collection
    {
        return $this->lesCasiers;
    }

    public function addLesCasier(Casier $lesCasier): static
    {
        if (!$this->lesCasiers->contains($lesCasier)) {
            $this->lesCasiers->add($lesCasier);
            $lesCasier->setLeEntrepot($this);
        }

        return $this;
    }

    public function removeLesCasier(Casier $lesCasier): static
    {
        if ($this->lesCasiers->removeElement($lesCasier)) {
            // set the owning side to null (unless already changed)
            if ($lesCasier->getLeEntrepot() === $this) {
                $lesCasier->setLeEntrepot(null);
            }
        }

        return $this;
    }
    public function creerCasier() 
    {
        for ($i = 0; $i < 50; $i++) {
            $leCasier = new Casier();
            $this->lesCasiers->add($leCasier);
        }
    }
    
}
