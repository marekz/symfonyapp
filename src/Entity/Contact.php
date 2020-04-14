<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *      itemOperations={
 *          "get",
 *          "put"={
 *              "access_control"="is_granted('IS_AUTHENTICATED_FULLY') and object.getUser() == user"
 *          }
 *      },
 *      collectionOperations={
 *          "get",
 *          "post"={
 *              "access_control"="is_granted('IS_AUTHENTICATED_FULLY')"
 *          }
 *      },
 *      normalizationContext={
 *          "groups"={"contact"}
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 * @UniqueEntity(fields="phone")
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"contact"})
     */
    private $id;
    
    /**
     *
     * @ORM\OneToOne(targetEntity="User", inversedBy="contact", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     * @Groups({"contact"})
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"contact"})
     * @Assert\NotBlank()
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"contact"})
     * @Assert\NotBlank()
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"contact"})
     * @Assert\NotBlank()
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"contact"})
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"contact"})
     */
    private $streetNr;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"contact"})
     */
    private $flatNr;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"contact"})
     */
    private $zipCode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getStreetNr(): ?string
    {
        return $this->streetNr;
    }

    public function setStreetNr(string $streetNr): self
    {
        $this->streetNr = $streetNr;

        return $this;
    }

    public function getFlatNr(): ?string
    {
        return $this->flatNr;
    }

    public function setFlatNr(string $flatNr): self
    {
        $this->flatNr = $flatNr;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }
    
    public function getUser(): User
    {
        return $this->user;
    }
    
    public function setUser(User $user): self
    {
        $this->user = $user;
        
        return $this;
    }
}
