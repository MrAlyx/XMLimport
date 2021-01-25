<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Filename;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ImageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Omschrijving;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Prijs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->Code;
    }

    public function setCode(?int $Code): self
    {
        $this->Code = $Code;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->Filename;
    }

    public function setFilename(?string $Filename): self
    {
        $this->Filename = $Filename;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getImageFile(): ?string
    {
        return $this->ImageFile;
    }

    public function setImageFile(?string $ImageFile): self
    {
        $this->ImageFile = $ImageFile;

        return $this;
    }

    public function getOmschrijving(): ?string
    {
        return $this->Omschrijving;
    }

    public function setOmschrijving(?string $Omschrijving): self
    {
        $this->Omschrijving = $Omschrijving;

        return $this;
    }

    public function getPrijs(): ?float
    {
        return $this->Prijs;
    }

    public function setPrijs(?float $Prijs): self
    {
        $this->Prijs = $Prijs;

        return $this;
    }
}
