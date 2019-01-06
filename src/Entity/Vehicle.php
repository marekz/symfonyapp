<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\VehicleRepository")
 */
class Vehicle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateProduction;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vinNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $vehicleMilage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    /**
     * @var
     * @ORM\ManyToMany(targetEntity="User", mappedBy="vehicles")
     */
    private $owners;

    public function __construct()
    {
        $this->owners = new ArrayCollection();
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
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

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
     * @return User
     */
    public function getOwners(): User
    {
        return $this->owners;
    }

    /**
     * @param User $owners
     */
    public function setOwners(User $owners): void
    {
        $this->owners = $owners;
    }


}
