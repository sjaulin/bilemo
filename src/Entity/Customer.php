<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CustomerRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 * @UniqueEntity(
 *     fields={"email", "user"},
 *     errorPath="email",
 *     message="This customer email is already in use on that user."
 * )
 * @Apiresource(
 *   normalizationContext = {"groups" = {"customers_collection_get"}}
 * )
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"customers_collection_get"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="email must not be null")
     * @Assert\Email(
     *     message = "email '{{ value }}' is not a valid email."
     * )
     * @Groups({"customers_collection_get"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="fullname must not be null")
     * @Groups({"customers_collection_get"})
     */
    private $fullname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="phone must not be null")
     * @Groups({"customers_collection_get"})
     */
    private $phone;

    /**
     * @ORM\Column(type="text", length=255)
     * @Assert\NotBlank(message="address must not be null")
     * @Groups({"customers_collection_get"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="zipcode must not be null")
     * @Groups({"customers_collection_get"})
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="city must not be null")
     * @Groups({"customers_collection_get"})
     */
    private $city;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(message="createdAt must not be null")
     * @Groups({"customers_collection_get"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="customers")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="user must not be null")
     * @Groups({"customers_collection_get"})
     */
    private $user;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
