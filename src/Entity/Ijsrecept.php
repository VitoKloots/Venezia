<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IjsreceptRepository")
 */
class Ijsrecept
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $naam;

    /**
     * @ORM\Column(type="text")
     */
    private $ingredientenlijst;

    /**
     * @ORM\Column(type="text")
     */
    private $recept;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $kosten;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fruit", inversedBy="ijsrecepts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fruit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bestelregel", mappedBy="ijsrecept")
     */
    private $bestelregels;

    public function __construct()
    {
        $this->bestelregels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getIngredientenlijst(): ?string
    {
        return $this->ingredientenlijst;
    }

    public function setIngredientenlijst(string $ingredientenlijst): self
    {
        $this->ingredientenlijst = $ingredientenlijst;

        return $this;
    }

    public function getRecept(): ?string
    {
        return $this->recept;
    }

    public function setRecept(string $recept): self
    {
        $this->recept = $recept;

        return $this;
    }

    public function getKosten(): ?string
    {
        return $this->kosten;
    }

    public function setKosten(string $kosten): self
    {
        $this->kosten = $kosten;

        return $this;
    }

    public function getFruit(): ?fruit
    {
        return $this->fruit;
    }

    public function setFruit(?fruit $fruit): self
    {
        $this->fruit = $fruit;

        return $this;
    }

    /**
     * @return Collection|Bestelregel[]
     */
    public function getBestelregels(): Collection
    {
        return $this->bestelregels;
    }

    public function addBestelregel(Bestelregel $bestelregel): self
    {
        if (!$this->bestelregels->contains($bestelregel)) {
            $this->bestelregels[] = $bestelregel;
            $bestelregel->setIjsrecept($this);
        }

        return $this;
    }

    public function removeBestelregel(Bestelregel $bestelregel): self
    {
        if ($this->bestelregels->contains($bestelregel)) {
            $this->bestelregels->removeElement($bestelregel);
            // set the owning side to null (unless already changed)
            if ($bestelregel->getIjsrecept() === $this) {
                $bestelregel->setIjsrecept(null);
            }
        }

        return $this;
    }
}
