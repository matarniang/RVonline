<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Rendezvous
 *
 * @ORM\Table(name="rendezvous")
 * @ORM\Entity
 */
class Rendezvous
{
    /**
     * @var int
     *
     * @ORM\Column(name="idRendezVous", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrendezvous;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="Date_Reservation", type="date", nullable=true)
     */
    private $dateReservation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="Date_rdv", type="date", nullable=true)
     */
    private $dateRdv;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="rendezvouses")
     * @ORM\JoinColumn(name="id_Patient", referencedColumnName="idPatient")
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity=Medecin::class, inversedBy="rendezvouses")
     * @ORM\JoinColumn(name="id_Medecin", referencedColumnName="idMedecin")
     */
    private $medecin;

    /**
     * @return int
     */
    public function getIdrendezvous(): int
    {
        return $this->idrendezvous;
    }

    /**
     * @param int $idrendezvous
     * @return Rendezvous
     */
    public function setIdrendezvous(int $idrendezvous): Rendezvous
    {
        $this->idrendezvous = $idrendezvous;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateReservation(): ?\DateTime
    {
        return $this->dateReservation;
    }

    /**
     * @param \DateTime|null $dateReservation
     * @return Rendezvous
     */
    public function setDateReservation(?\DateTime $dateReservation): Rendezvous
    {
        $this->dateReservation = $dateReservation;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateRdv(): ?\DateTime
    {
        return $this->dateRdv;
    }

    /**
     * @param \DateTime|null $dateRdv
     * @return Rendezvous
     */
    public function setDateRdv(?\DateTime $dateRdv): Rendezvous
    {
        $this->dateRdv = $dateRdv;
        return $this;
    }


    /**
     * @ORM\OneToMany(targetEntity=Facture::class, mappedBy="rendezvous")
     */
    private $factures;

    public function __construct()
    {
        $this->factures = new ArrayCollection();
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

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
            $facture->setRendezvous($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->factures->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getRendezvous() === $this) {
                $facture->setRendezvous(null);
            }
        }

        return $this;
    }


}
