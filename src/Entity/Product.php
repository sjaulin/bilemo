<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\ProductRepository; // Avoid class naming error.

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ApiResource(
 *   collectionOperations={
 *     "get"={
 *       "normalization_context"={
 *         "groups"={"products_list"}
 *       }
 *     }
 *   },
 *   itemOperations={
 *     "get"={
 *       "normalization_context"={
 *         "groups"={"products_detail"}
 *       }
 *     },
 *   },
 * )
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"products_list", "products_detail"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"products_detail"})
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"products_detail"})
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"products_detail"})
     */
    private $reference;

    /**
     * @ORM\Column(type="float")
     * @Groups({"products_detail"})
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
