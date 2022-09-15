<?php

namespace App\Entity;

use App\Repository\PiloteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PiloteRepository::class)]
#[ORM\Table(name: "race__pilote")]
class Pilote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

//    #[ORM\OneToOne(mappedBy: "pilote", targetEntity: Car::class, cascade: ['persist', 'remove'])]
//    private ?Car $car = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $number = null;

    #[ORM\ManyToOne(targetEntity: Car::class, inversedBy: 'pilotes')]
    private ?Car $car = null;

    public function __toString() : string
    {
        return (string) $this->firstName . " " . $this->lastName . " n°" . $this->number;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

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

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): self
    {
        $this->car = $car;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }
}
