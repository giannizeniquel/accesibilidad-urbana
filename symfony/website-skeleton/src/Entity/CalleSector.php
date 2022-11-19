<?php

namespace App\Entity;

use App\Repository\CalleSectorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CalleSectorRepository::class)
 */
class CalleSector
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Calle::class, inversedBy="calleSectors")
     */
    private $idCalle;

    /**
     * @ORM\ManyToOne(targetEntity=Sector::class, inversedBy="calleSectors")
     */
    private $idSector;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCalle(): ?Calle
    {
        return $this->idCalle;
    }

    public function setIdCalle(?Calle $idCalle): self
    {
        $this->idCalle = $idCalle;

        return $this;
    }

    public function getIdSector(): ?Sector
    {
        return $this->idSector;
    }

    public function setIdSector(?Sector $idSector): self
    {
        $this->idSector = $idSector;

        return $this;
    }
}
