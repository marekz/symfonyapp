<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Asert;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * @ApiResource(
 *     itemOperations={
 *          "get" = {
 *              "access_control"="is_granted('IS_AUTHENTICATED_FULLY')"
 *          }
 *      },
 *     collectionOperations={"post"},
 *     normalizationContext={
 *          "groups"={"vehicle"}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\VehicleRepository")
 * @UniqueEntity(fields="vinNumber")
 */
class Vehicle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"vehicle"})
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="VehicleModel", inversedBy="vehicleModel", cascade={"persist"})
     * @ORM\JoinColumn(name="model_id", referencedColumnName="id", nullable=false)
     */
    private $model;
    
    /**
     * @ORM\ManyToOne(targetEntity="VehicleProducer", inversedBy="vehicleProducer", cascade={"persist"})
     * @ORM\JoinColumn(name="producer_id", referencedColumnName="id", nullable=false)
     */
    private $producer;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"vehicle"})
     */
    private $dateProduction;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"vehicle"})
     */
    private $vinNumber;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"vehicle"})
     */
    private $vehicleMilage;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"vehicle"})
     */
    private $createAt;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="vehicles")
     * @Groups({"vehicle"})
     * @ApiSubresource()
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateProduction(): ?\DateTimeInterface
    {
        return $this->dateProduction;
    }

    public function setDateProduction(\DateTimeInterface $dateProduction): self
    {
        $this->dateProduction = $dateProduction;

        return $this;
    }

    public function getVinNumber(): ?string
    {
        return $this->vinNumber;
    }

    public function setVinNumber(string $vinNumber): self
    {
        $this->vinNumber = $vinNumber;

        return $this;
    }

    public function getVehicleMilage(): ?int
    {
        return $this->vehicleMilage;
    }

    public function setVehicleMilage(int $vehicleMilage): self
    {
        $this->vehicleMilage = $vehicleMilage;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * @param mixed $createAt
     */
    public function setCreateAt($createAt): void
    {
        $this->createAt = $createAt;
    }

    /**
     * @return Collection
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }
    
    public function addUser(User $user): self
    {
        $this->users[] = $user;
        return $this;
    }
    
    public function removeUser(User $user): bool
    {
        return $this->users->removeElement($user);
    }
    
    public function getModel(): VehicleModel
    {
        return $this->model;
    }

    public function getProducer(): VehicleProducer
    {
        return $this->producer;
    }

    public function setModel(VehicleModel $model): self
    {
        $this->model = $model;
        return $this;
    }

    public function setProducer(VehicleProducer $producer): self
    {
        $this->producer = $producer;
        return $this;
    }
}
