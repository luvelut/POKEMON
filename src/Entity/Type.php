<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */
class Type
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\ManyToMany(targetEntity=Pokemon::class, mappedBy="type")
     */
    private $listPokemon;

    public function __construct()
    {
        $this->listPokemon = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Pokemon>
     */
    public function getListPokemon(): Collection
    {
        return $this->listPokemon;
    }

    public function addListPokemon(Pokemon $listPokemon): self
    {
        if (!$this->listPokemon->contains($listPokemon)) {
            $this->listPokemon[] = $listPokemon;
            $listPokemon->addType($this);
        }

        return $this;
    }

    public function removeListPokemon(Pokemon $listPokemon): self
    {
        if ($this->listPokemon->removeElement($listPokemon)) {
            $listPokemon->removeType($this);
        }

        return $this;
    }
}
