<?php

namespace App\Entity;

use App\Repository\SectorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SectorRepository::class)
 */
class Sector
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $alturaInicial;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $alturaFinal;

    /**
     * @ORM\OneToMany(targetEntity=CalleSector::class, mappedBy="idSector")
     */
    private $calleSectors;

    public function __construct()
    {
        $this->calleSectors = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getAlturaInicial(): ?string
    {
        return $this->alturaInicial;
    }

    public function setAlturaInicial(?string $alturaInicial): self
    {
        $this->alturaInicial = $alturaInicial;

        return $this;
    }

    public function getAlturaFinal(): ?string
    {
        return $this->alturaFinal;
    }

    public function setAlturaFinal(?string $alturaFinal): self
    {
        $this->alturaFinal = $alturaFinal;

        return $this;
    }

    /**
     * @return Collection<int, CalleSector>
     */
    public function getCalleSectors(): Collection
    {
        return $this->calleSectors;
    }

    public function addCalleSector(CalleSector $calleSector): self
    {
        if (!$this->calleSectors->contains($calleSector)) {
            $this->calleSectors[] = $calleSector;
            $calleSector->setIdSector($this);
        }

        return $this;
    }

    public function removeCalleSector(CalleSector $calleSector): self
    {
        if ($this->calleSectors->removeElement($calleSector)) {
            // set the owning side to null (unless already changed)
            if ($calleSector->getIdSector() === $this) {
                $calleSector->setIdSector(null);
            }
        }

        return $this;
    }
}
