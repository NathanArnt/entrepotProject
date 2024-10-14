<?php

namespace App\Entity;

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

    #[ORM\Column(length: 25)]
    private ?string $statut;

    public function __construct()
    {
        $this->lesDistances = new ArrayCollection();
        $this->statut = 'incomplet';
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

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }
}
