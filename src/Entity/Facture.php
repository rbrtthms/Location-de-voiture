<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateF;

    /**
     * @ORM\Column(type="integer")
     */
    private $valeur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etatR;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="facture")
     */
    private $idC;

    /**
     * @ORM\OneToOne(targetEntity=Vehicule::class, cascade={"persist", "remove"})
     */
    private $idV;

    /**
     * @ORM\Column(type="date")
     */
    private $dateD;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateF(): ?\DateTimeInterface
    {
        return $this->dateF;
    }

    public function setDateF(\DateTimeInterface $dateF): self
    {
        $this->dateF = $dateF;

        return $this;
    }

    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    public function setValeur(int $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getEtatR(): ?bool
    {
        return $this->etatR;
    }

    public function setEtatR(bool $etatR): self
    {
        $this->etatR = $etatR;

        return $this;
    }

    public function getDateD(): ?\DateTimeInterface
    {
        return $this->dateD;
    }

    public function setDateD(\DateTimeInterface $dateD): self
    {
        $this->dateD = $dateD;

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return "valeur: " . $this->getValeur().
            "etatR: ". $this->getEtatR().
            "idC: " . $this->getIdC().
            "idV: " . $this->getIdV().
            "dateD: " . $this->getDateD()->format('Y-m-d').
            "dateF: " . $this->getDateF()->format('Y-m-d');
    }

    public function getIdC(): ?Client
    {
        return $this->idC;
    }

    public function setIdC(?Client $idC): self
    {
        $this->idC = $idC;

        return $this;
    }

    public function getIdV(): ?Vehicule
    {
        return $this->idV;
    }

    public function setIdV(?Vehicule $idV): self
    {
        $this->idV = $idV;

        return $this;
    }
}
