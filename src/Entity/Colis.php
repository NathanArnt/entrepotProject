<?php

namespace App\Entity;

use App\Repository\ColisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColisRepository::class)]
class Colis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'lesColis')]
    private ?Ville $laVille = null;

    #[ORM\ManyToOne]
    private ?Taille $laTaille = null;

    /**
     * @var Collection<int, Compartiments>
     */
    #[ORM\OneToMany(targetEntity: Compartiments::class, mappedBy: 'leColis')]
    private Collection $lesCompartiments;

    public function __construct()
    {
        $this->lesCompartiments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $lesCompartiment->setLeColis($this);
        }

        return $this;
    }

    public function removeLesCompartiment(Compartiments $lesCompartiment): static
    {
        if ($this->lesCompartiments->removeElement($lesCompartiment)) {
            // set the owning side to null (unless already changed)
            if ($lesCompartiment->getLeColis() === $this) {
                $lesCompartiment->setLeColis(null);
            }
        }

        return $this;
    }
}
