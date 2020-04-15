<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\VehicleProducerRepository")
 */
class VehicleProducer
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
     * @ORM\OneToMany(targetEntity="VehicleModel", mappedBy="producer", cascade={"persist", "remove"})
     */
    private $models;
    
    /**
     * @ORM\OneToMany(targetEntity="Vehicle", mappedBy="producer", cascade={"persist", "remove"})
     */
    private $vehicleProducer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;
    
    public function __construct() {
        $this->models = new ArrayCollection();
    }

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function addModel(VehicleModel $model): self
    {
        $this->models[] = $model;
        return $this;
    }
    
    public function removeModel(VehicleModel $model) {
        return $this->models->removeElement($model);
    }
    
    public function getModels(): Collection {
        return $this->models;
    }
    
    public function getVehicleProducer(): VehicleProducer
    {
        return $this->vehicleProducer;
    }

    public function setVehicleProducer(VehicleProducer $vehicleProducer): self
    {
        $this->vehicleProducer = $vehicleProducer;
        return $this;
    }


}
