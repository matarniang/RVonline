<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ordonnance
 *
 * @ORM\Table(name="ordonnance")
 * @ORM\Entity
 */
class Ordonnance
{
    /**
     * @var int
     *
     * @ORM\Column(name="idOrdonnance", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idordonnance;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Medicament", type="string", length=20, nullable=true)
     */
    private $medicament;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="ordonnances")
     * @ORM\JoinColumn(name="id_Patient", referencedColumnName="idPatient")
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity=Facture::class, inversedBy="ordonnances")
     * @ORM\JoinColumn(name="id_traitement", referencedColumnName="idtraitement")
     */
    private $facture;

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(?Facture $facture): self
    {
        $this->facture = $facture;

        return $this;
    }

    /**
     * @return int
     */
    public function getIdordonnance(): int
    {
        return $this->idordonnance;
    }

    /**
     * @param int $idordonnance
     */
    public function setIdordonnance(int $idordonnance): void
    {
        $this->idordonnance = $idordonnance;
    }

    /**
     * @return string|null
     */
    public function getMedicament(): ?string
    {
        return $this->medicament;
    }

    /**
     * @param string|null $medicament
     */
    public function setMedicament(?string $medicament): void
    {
        $this->medicament = $medicament;
    }


}
