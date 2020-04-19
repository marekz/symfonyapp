<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\VehicleModelRepository")
 */
class VehicleModel
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
     *
     * @ORM\ManyToOne(targetEntity="VehicleProducer", inversedBy="producers", cascade={"persist"})
     * @ORM\JoinColumn(name="producer_id", referencedColumnName="id", nullable=false)
     */
    private $producer;
    
    /**
     * @ORM\OneToMany(targetEntity="Vehicle", mappedBy="model", cascade={"persist", "remove"})
     */
    private $vehicleModel;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

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
    
    public function getProducer(): VehicleProducer
    {
        return $this->producer;
    }

    public function setProducer(VehicleProducer $producer): self
    {
        $this->producer = $producer;
        return $this;
    }
    
    public function getVehicleModel(): VehicleModel
    {
        return $this->vehicleModel;
    }

    public function setVehicleModel(VehicleModel $vehicleModel): self
    {
        $this->vehicleModel = $vehicleModel;
        return $this;
    }


}
