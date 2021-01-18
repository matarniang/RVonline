<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Horaire
 *
 * @ORM\Table(name="horaire")
 * @ORM\Entity
 */
class Horaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="idTimings", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtimings;

    /**
     * @var string
     *
     * @ORM\Column(name="Time", type="string", length=255, nullable=false)
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity=Medecin::class, inversedBy="horaires")
     * @ORM\JoinColumn(name="id_Medecin", referencedColumnName="idMedecin")
     */
    private $medecin;

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
     * @return int
     */
    public function getIdtimings(): int
    {
        return $this->idtimings;
    }

    /**
     * @param int $idtimings
     */
    public function setIdtimings(int $idtimings): void
    {
        $this->idtimings = $idtimings;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime(string $time): void
    {
        $this->time = $time;
    }


}
