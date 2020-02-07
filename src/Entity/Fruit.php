<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FruitRepository")
 */
class Fruit
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
     * @ORM\Column(type="string", length=255)
     */
    private $seizoen;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ijsrecept", mappedBy="fruit")
     */
    private $ijsrecepts;

    public function __construct()
    {
        $this->ijsrecepts = new ArrayCollection();
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

    public function getSeizoen(): ?string
    {
        return $this->seizoen;
    }

    public function setSeizoen(string $seizoen): self
    {
        $this->seizoen = $seizoen;

        return $this;
    }

    /**
     * @return Collection|Ijsrecept[]
     */
    public function getIjsrecepts(): Collection
    {
        return $this->ijsrecepts;
    }

    public function addIjsrecept(Ijsrecept $ijsrecept): self
    {
        if (!$this->ijsrecepts->contains($ijsrecept)) {
            $this->ijsrecepts[] = $ijsrecept;
            $ijsrecept->setFruit($this);
        }

        return $this;
    }

    public function removeIjsrecept(Ijsrecept $ijsrecept): self
    {
        if ($this->ijsrecepts->contains($ijsrecept)) {
            $this->ijsrecepts->removeElement($ijsrecept);
            // set the owning side to null (unless already changed)
            if ($ijsrecept->getFruit() === $this) {
                $ijsrecept->setFruit(null);
            }
        }

        return $this;
    }
}
