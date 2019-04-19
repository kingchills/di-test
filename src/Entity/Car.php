<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
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
    private $make;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Motor", inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $motor;

    /**
     * @ORM\Column(type="boolean")
     */
    private $concept = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMake(): ?string
    {
        return $this->make;
    }

    public function setMake(string $make): self
    {
        $this->make = $make;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getMotor(): ?Motor
    {
        return $this->motor;
    }

    public function setMotor(?Motor $motor): self
    {
        $this->motor = $motor;

        return $this;
    }

    public function getConcept(): ?bool
    {
        return $this->concept;
    }

    public function setConcept(bool $concept): self
    {
        $this->concept = $concept;

        return $this;
    }
}
