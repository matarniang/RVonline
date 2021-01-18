<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Medecin
 *
 * @ORM\Table(name="medecin")
 * @ORM\Entity
 * @UniqueEntity(
 *     fields={"email"},
 *     message="l 'email que vous avez indiqué est deja utilisé !"
 * )
 */
class Medecin implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="idMedecin", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmedecin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Specialite", type="string", length=255, nullable=true)
     */
    private $specialite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Email", type="string", length=255, nullable=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Contact", type="string", length=255, nullable=true)
     */
    private $contact;

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     * @return Medecin
     */
    public function setPassword(?string $password): Medecin
    {
        $this->password = $password;
        return $this;
    }
    /**
     * @var string/null
     *
     * @ORM\Column(name="Password", type="string", length=255, nullable=true)
     * @Assert\Length(min="8",minMessage="votre mot de passe doit faire minimum 8 caractéres ")
     *
     */
    private $password;
    /**
     * @Assert\EqualTo(propertyPath="password",message="vous avez pas tapé le meme mot de passe ")
     */
    private $confirme_password;

    /**
     * @return mixed
     */
    public function getConfirmePassword()
    {
        return $this->confirme_password;
    }

    /**
     * @param mixed $confirme_password
     * @return Medecin
     */
    public function setConfirmePassword($confirme_password)
    {
        $this->confirme_password = $confirme_password;
        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity=Rendezvous::class, mappedBy="medecin")
     */
    private $rendezvouses;

    /**
     * @ORM\OneToMany(targetEntity=Horaire::class, mappedBy="medecin")
     */
    private $horaires;

    /**
     * @ORM\OneToMany(targetEntity=Facture::class, mappedBy="medecin")
     */
    private $factures;

    public function __construct()
    {
        $this->rendezvouses = new ArrayCollection();
        $this->horaires = new ArrayCollection();
        $this->factures = new ArrayCollection();
    }

    /**
     * @return Collection|Rendezvous[]
     */
    public function getRendezvouses(): Collection
    {
        return $this->rendezvouses;
    }

    public function addRendezvouse(Rendezvous $rendezvouse): self
    {
        if (!$this->rendezvouses->contains($rendezvouse)) {
            $this->rendezvouses[] = $rendezvouse;
            $rendezvouse->setMedecin($this);
        }

        return $this;
    }

    public function removeRendezvouse(Rendezvous $rendezvouse): self
    {
        if ($this->rendezvouses->removeElement($rendezvouse)) {
            // set the owning side to null (unless already changed)
            if ($rendezvouse->getMedecin() === $this) {
                $rendezvouse->setMedecin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Horaire[]
     */
    public function getHoraires(): Collection
    {
        return $this->horaires;
    }

    public function addHoraire(Horaire $horaire): self
    {
        if (!$this->horaires->contains($horaire)) {
            $this->horaires[] = $horaire;
            $horaire->setMedecin($this);
        }

        return $this;
    }

    public function removeHoraire(Horaire $horaire): self
    {
        if ($this->horaires->removeElement($horaire)) {
            // set the owning side to null (unless already changed)
            if ($horaire->getMedecin() === $this) {
                $horaire->setMedecin(null);
            }
        }

        return $this;
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
            $facture->setMedecin($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->factures->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getMedecin() === $this) {
                $facture->setMedecin(null);
            }
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getIdmedecin(): int
    {
        return $this->idmedecin;
    }

    /**
     * @param int $idmedecin
     */
    public function setIdmedecin(int $idmedecin): void
    {
        $this->idmedecin = $idmedecin;
    }

    /**
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string|null $nom
     */
    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string|null
     */
    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    /**
     * @param string|null $specialite
     */
    public function setSpecialite(?string $specialite): void
    {
        $this->specialite = $specialite;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getContact(): ?string
    {
        return $this->contact;
    }

    /**
     * @param string|null $contact
     */
    public function setContact(?string $contact): void
    {
        $this->contact = $contact;
    }


    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getSalt()
    {
        //  TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
