<?php

namespace App\Entity;

use App\Repository\CalleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CalleRepository::class)
 */
class Calle
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
     * @ORM\OneToMany(targetEntity=CalleSector::class, mappedBy="idCalle")
     */
    private $calleSectors;

    /**
     * @ORM\OneToMany(targetEntity=Incidente::class, mappedBy="calles")
     */
    private $incidentes;

    public function __construct()
    {
        $this->calleSectors = new ArrayCollection();
        $this->incidentes = new ArrayCollection();
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
            $calleSector->setIdCalle($this);
        }

        return $this;
    }

    public function removeCalleSector(CalleSector $calleSector): self
    {
        if ($this->calleSectors->removeElement($calleSector)) {
            // set the owning side to null (unless already changed)
            if ($calleSector->getIdCalle() === $this) {
                $calleSector->setIdCalle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Incidente>
     */
    public function getIncidentes(): Collection
    {
        return $this->incidentes;
    }

    public function addIncidente(Incidente $incidente): self
    {
        if (!$this->incidentes->contains($incidente)) {
            $this->incidentes[] = $incidente;
            $incidente->setCalles($this);
        }

        return $this;
    }

    public function removeIncidente(Incidente $incidente): self
    {
        if ($this->incidentes->removeElement($incidente)) {
            // set the owning side to null (unless already changed)
            if ($incidente->getCalles() === $this) {
                $incidente->setCalles(null);
            }
        }

        return $this;
    }
}
