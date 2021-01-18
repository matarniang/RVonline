<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture")
 * @ORM\Entity
 */
class Facture
{
    /**
     * @var int
     *
     * @ORM\Column(name="idtraitement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtraitement;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Frais", type="integer", nullable=true)
     */
    private $frais;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Traitement", type="string", length=20, nullable=true)
     */
    private $traitement;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="Date_", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Heure", type="string", length=10, nullable=true)
     */
    private $heure;

    /**
     * @ORM\OneToMany(targetEntity=Ordonnance::class, mappedBy="facture")
     */
    private $ordonnances;

    /**
     * @ORM\ManyToOne(targetEntity=Medecin::class, inversedBy="factures")
     * @ORM\JoinColumn(name="id_Medecin", referencedColumnName="idMedecin")
     */
    private $medecin;

    /**
     * @ORM\ManyToOne(targetEntity=Rendezvous::class, inversedBy="factures")
     * @ORM\JoinColumn(name="id_RendezVous", referencedColumnName="idRendezVous")
     */
    private $rendezvous;

    public function __construct()
    {
        $this->ordonnances = new ArrayCollection();
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
            $ordonnance->setFacture($this);
        }

        return $this;
    }

    public function removeOrdonnance(Ordonnance $ordonnance): self
    {
        if ($this->ordonnances->removeElement($ordonnance)) {
            // set the owning side to null (unless already changed)
            if ($ordonnance->getFacture() === $this) {
                $ordonnance->setFacture(null);
            }
        }

        return $this;
    }

    public function getMedecin(): ?Medecin
    {
        return $this->medecin;
    }

    public function setMedecin(?Medecin $medecin): self
    {
        $this->medecin = $medecin;

        return $this;
    }

    public function getRendezvous(): ?Rendezvous
    {
        return $this->rendezvous;
    }

    public function setRendezvous(?Rendezvous $rendezvous): self
    {
        $this->rendezvous = $rendezvous;

        return $this;
    }

    /**
     * @return int
     */
    public function getIdtraitement(): int
    {
        return $this->idtraitement;
    }

    /**
     * @param int $idtraitement
     */
    public function setIdtraitement(int $idtraitement): void
    {
        $this->idtraitement = $idtraitement;
    }

    /**
     * @return int|null
     */
    public function getFrais(): ?int
    {
        return $this->frais;
    }

    /**
     * @param int|null $frais
     */
    public function setFrais(?int $frais): void
    {
        $this->frais = $frais;
    }

    /**
     * @return string|null
     */
    public function getTraitement(): ?string
    {
        return $this->traitement;
    }

    /**
     * @param string|null $traitement
     */
    public function setTraitement(?string $traitement): void
    {
        $this->traitement = $traitement;
    }

    /**
     * @return \DateTime|null
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime|null $date
     */
    public function setDate(?\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string|null
     */
    public function getHeure(): ?string
    {
        return $this->heure;
    }

    /**
     * @param string|null $heure
     */
    public function setHeure(?string $heure): void
    {
        $this->heure = $heure;
    }


}
