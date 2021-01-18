<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Patient
 *
 * @ORM\Table(name="patient")
 * @ORM\Entity
 * @UniqueEntity(
 *     fields={"email"},
 *     message="l 'email que vous avez indiqué est deja utilisé !"
 * )
 */
class Patient implements \Symfony\Component\Security\Core\User\UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPatient", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpatient;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Nom", type="string", length=20, nullable=true)
     */
    private $nom;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="Date_Naissance", type="date", nullable=true)
     */
    private $dateNaissance;

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
     * @ORM\Column(name="Numero_Telephone", type="string", length=255, nullable=true)
     */
    private $numeroTelephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     * @Assert\Length(min="8",minMessage="votre mot de passe doit faire minimum 8 caractéres ")
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
     * @return Patient
     */
    public function setConfirmePassword($confirme_password)
    {
        $this->confirme_password = $confirme_password;
        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity=Rendezvous::class, mappedBy="patient")
     */
    private $rendezvouses;

    /**
     * @ORM\OneToMany(targetEntity=Ordonnance::class, mappedBy="patient")
     */
    private $ordonnances;

    public function __construct()
    {
        $this->rendezvouses = new ArrayCollection();
        $this->ordonnances = new ArrayCollection();
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
            $rendezvouse->setPatient($this);
        }

        return $this;
    }

    public function removeRendezvouse(Rendezvous $rendezvouse): self
    {
        if ($this->rendezvouses->removeElement($rendezvouse)) {
            // set the owning side to null (unless already changed)
            if ($rendezvouse->getPatient() === $this) {
                $rendezvouse->setPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ordonnance[]
     */
    public function getOrdonnances(): Collection
    {
        return $this->ordonnances;
    }

    public function addOrdonnance(Ordonnance $ordonnance): self
    {
        if (!$this->ordonnances->contains($ordonnance)) {
            $this->ordonnances[] = $ordonnance;
            $ordonnance->setPatient($this);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getIdpatient(): int
    {
        return $this->idpatient;
    }

    /**
     * @param int $idpatient
     */
    public function setIdpatient(int $idpatient): void
    {
        $this->idpatient = $idpatient;
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
     * @return DateTime|null
     */
    public function getDateNaissance(): ?DateTime
    {
        return $this->dateNaissance;
    }

    /**
     * @param DateTime|null $dateNaissance
     */
    public function setDateNaissance(?DateTime $dateNaissance): void
    {
        $this->dateNaissance = $dateNaissance;
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
    public function getNumeroTelephone(): ?string
    {
        return $this->numeroTelephone;
    }

    /**
     * @param string|null $numeroTelephone
     */
    public function setNumeroTelephone(?string $numeroTelephone): void
    {
        $this->numeroTelephone = $numeroTelephone;
    }

    /**
     * @return string|null
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * @param string|null $adresse
     */
    public function setAdresse(?string $adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function removeOrdonnance(Ordonnance $ordonnance): self
    {
        if ($this->ordonnances->removeElement($ordonnance)) {
            // set the owning side to null (unless already changed)
            if ($ordonnance->getPatient() === $this) {
                $ordonnance->setPatient(null);
            }
        }

        return $this;
    }


    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
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
