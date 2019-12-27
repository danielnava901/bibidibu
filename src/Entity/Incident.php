<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncidentRepository")
 */
class Incident implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $last_incident;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $last_record_in_days;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastIncident(): ?int
    {
        return $this->last_incident;
    }

    public function setLastIncident(?int $last_incident): self
    {
        $this->last_incident = $last_incident;

        return $this;
    }

    public function getLastRecordInDays(): ?int
    {
        return $this->last_record_in_days;
    }

    public function setLastRecordInDays(?int $last_record_in_days): self
    {
        $this->last_record_in_days = $last_record_in_days;

        return $this;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
