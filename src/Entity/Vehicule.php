<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VehiculeRepository::class)
 */
class Vehicule
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(
     *     maxSize="10M",
     *     maxSizeMessage="fichier trop volumineux"
     * )
     */
    private $photo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $caracteres;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getCaracteres(): ?string
    {
        return $this->caracteres;
    }

    public function setCaracteres(string $caracteres): self
    {
        $this->caracteres = $caracteres;

        return $this;
    }


    public function __toString()
    {
        // TODO: Implement __toString() method.
        return "type : " . $this->getName().
            "caractere : " . $this->getCaracteres().
            "photo : " . $this->getPhoto().
            "etat : " . $this->getEtat();
    }
}
