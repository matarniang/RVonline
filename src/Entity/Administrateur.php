<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Administrateur
 *
 * @ORM\Table(name="administrateur")
 * @ORM\Entity
 * @UniqueEntity(
 *     fields={"email"},
 *     message="l 'email que vous avez indiqué est deja utilisé !"
 * )
 */
class Administrateur implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="idAdministrateur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idadministrateur;

    /**
     * @return int
     */
    public function getIdadministrateur(): int
    {
        return $this->idadministrateur;
    }

    /**
     * @param int $idadministrateur
     */
    public function setIdadministrateur(int $idadministrateur): void
    {
        $this->idadministrateur = $idadministrateur;
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

    /**
     * @var string|null
     *
     * @ORM\Column(name="Nom", type="string", length=20, nullable=true)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Email", type="string", length=30, nullable=true)
     * @Assert\Email()
     */
    private $email;

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
    private  $confirme_password;

    /**
     * @return mixed
     */
    public function getConfirmePassword()
    {
        return $this->confirme_password;
    }

    /**
     * @param mixed $confirme_password
     * @return Administrateur
     */
    public function setConfirmePassword($confirme_password)
    {
        $this->confirme_password = $confirme_password;
        return $this;
    }


    public function getRoles()
    {
        return ['ROLE_ADIM'];
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername(): ?string
    {
        return $this->nom;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
