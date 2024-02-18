<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client implements PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     min={2},
     *     max={255},
     *     minMessage="Nom trop court minimum 3 caracteres",
     *     maxMessage="Non trop long maximum 255 caracteres")
     * @Assert\Regex(
     *     pattern="/([A-ZÀ-ÿ][a-z]*)+[ ]([A-ZÀ-ÿ][a-z]*)/",
     *     message="Entrer un nom valide")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message="email incorrect")
     *
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     min={2},
     *     max={255},
     *     minMessage="pseudo trop court minimum 3 caracteres",
     *     maxMessage="pseudo trop long maximum 255 caracteres")
     * @Assert\Regex (pattern="/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/",
     *     message="Mot de passe non sécurité, il doit contenir 8 caractères minimum et avoir un caractère spécial parmi ! @ # $%")
     * @Assert\NotCompromisedPassword(message="mot de passe non sécurisé")
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex (pattern="/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/",
     *     message="Mot de passe non sécurité, il doit contenir 8 caractères minimum et avoir un caractère spécial parmi ! @ # $%")
     * @Assert\NotCompromisedPassword(message="mot de passe non sécurisé")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Le premier mot de passe ne correspond pas au premier mot de passe")
     */
    private $passwordVerify;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=Facture::class, mappedBy="idC")
     */
    private $factures;

    public function __construct()
    {
        $this->factures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPasswordVerify()
    {
        return $this->passwordVerify;
    }

    /**
     * @return Collection|Facture[]
     */
    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function addFacture(Facture $facture): self
    {
        if (!$this->factures->contains($facture)) {
            $this->factures[] = $facture;
            $facture->setIdC($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->factures->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getIdC() === $this) {
                $facture->setIdC(null);
            }
        }

        return $this;
    }

    /**
     * @param mixed $passwordVerify
     */
    public function setPasswordVerify($passwordVerify): void
    {
        $this->passwordVerify = $passwordVerify;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return "nom : ". $this->getNom().
            "prenom : ". $this->getPrenom().
            "pseudom : ". $this->getPrenom().
            "mdp : ". $this->getPassword().
            "email : ". $this->getEmail().
            "adresse : ". $this->getAdresse();
        }
}
