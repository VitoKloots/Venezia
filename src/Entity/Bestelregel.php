<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BestelregelRepository")
 */
class Bestelregel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $aantal;

    /**
     * @ORM\Column(type="date")
     */
    private $afleverdatum;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $betaald;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ijsrecept", inversedBy="bestelregels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ijsrecept;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bestelregels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAantal(): ?int
    {
        return $this->aantal;
    }

    public function setAantal(int $aantal): self
    {
        $this->aantal = $aantal;

        return $this;
    }

    public function getAfleverdatum(): ?\DateTimeInterface
    {
        return $this->afleverdatum;
    }

    public function setAfleverdatum(\DateTimeInterface $afleverdatum): self
    {
        $this->afleverdatum = $afleverdatum;

        return $this;
    }

    public function getBetaald(): ?string
    {
        return $this->betaald;
    }

    public function setBetaald(?string $betaald): self
    {
        $this->betaald = $betaald;

        return $this;
    }

    public function getIjsrecept(): ?ijsrecept
    {
        return $this->ijsrecept;
    }

    public function setIjsrecept(?ijsrecept $ijsrecept): self
    {
        $this->ijsrecept = $ijsrecept;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }
}
