<?php

namespace App\Entity;

use App\Repository\CarPiloteRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Sortable\Entity\Repository\SortableRepository;

#[ORM\Entity(repositoryClass: SortableRepository::class)]
#[ORM\Table(name: "race__car_pilote")]
class CarPilote
{



    #[ORM\Id]
    #[ORM\ManyToOne(cascade: ["persist", "remove"], inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pilote $pilote = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'pilotes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Car $car = null;

//    #[Gedmo\SortablePosition]
    #[ORM\Column(nullable: true)]
    private ?int $position = null;

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getPilote(): ?Pilote
    {
        return $this->pilote;
    }

    public function setPilote(?Pilote $pilote): self
    {
        $this->pilote = $pilote;

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
}
