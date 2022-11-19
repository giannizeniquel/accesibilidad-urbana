<?php

namespace App\Entity;

use App\Repository\IncidenteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IncidenteRepository::class)
 */
class Incidente
{
 
    private $motivoString =
        [
        1 => 'Bacheo.',
        2 => 'Protesta.',
        3 => 'Inundaciones.',
        4 => 'Accidente de Trafico.',
        5 => 'Obra Pública.',
        6 =>'Otro.'
    ];

    private $tempString = [
        1 => 'Temporal(horas)',
        2 => 'SemiTemporal(dias)',
        3 => 'Permanente(indefinido)'
    ];
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $motivo;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $temporalidad;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $logitud;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $latitud;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $incidencia;

    /**
     * @ORM\ManyToOne(targetEntity=Calle::class, inversedBy="incidentes")
     */
    private $calles;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $altura;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotivo(): ?int
    {
        return $this->motivo;
    }

    public function setMotivo(?int $motivo): self
    {
        $this->motivo = $motivo;

        return $this;
    }

    public function getTemporalidad(): ?int
    {
        return $this->temporalidad;
    }

    public function setTemporalidad(int $temporalidad): self
    {
        $this->temporalidad = $temporalidad;

        return $this;
    }

    public function getLogitud(): ?string
    {
        return $this->logitud;
    }

    public function setLogitud(?string $logitud): self
    {
        $this->logitud = $logitud;

        return $this;
    }

    public function getLatitud(): ?string
    {
        return $this->latitud;
    }

    public function setLatitud(?string $latitud): self
    {
        $this->latitud = $latitud;

        return $this;
    }

    public function getIncidencia(): ?int
    {
        return $this->incidencia;
    }

    public function setIncidencia(?int $incidencia): self
    {
        $this->incidencia = $incidencia;

        return $this;
    }

    public function getCalles(): ?Calle
    {
        return $this->calles;
    }

    public function setCalles(?Calle $calles): self
    {
        $this->calles = $calles;

        return $this;
    }

    public function getAltura(): ?int
    {
        return $this->altura;
    }

    public function setAltura(?int $altura): self
    {
        $this->altura = $altura;

        return $this;
    }

    public function getStringMotivo(){
        return $this->motivoString[$this->motivo];
    }

    public function getStringTemporalidad(){
        return $this->tempString[$this->temporalidad];
    }

    public function getSector(){

        for ($i=0;$i<count($this->getCalles()->getCalleSectors());$i++){
            $sectores=$this->getCalles()->getCalleSectors()[$i];
            if ($sectores->getIdSector()->getAlturaInicial() < $this->altura && 
            $sectores->getIdSector()->getAlturaFinal()> $this->altura){
                return $sectores->getIdSector()->__toString();
                break;
            }
        }
        return 'zona en desarrollo';
    }
}
