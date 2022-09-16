<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
#[ORM\Table(name: "race__team")]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $headOffice = null;

    #[ORM\Column]
    private ?int $numberEmployees = null;

    #[ORM\OneToMany(mappedBy: 'team', targetEntity: Car::class)]
    private Collection $cars;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }

    public function __toString(): string
    {
        return (string)  $this->name . "  in ". $this->headOffice;
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

    public function getHeadOffice(): ?string
    {
        return $this->headOffice;
    }

    public function setHeadOffice(string $headOffice): self
    {
        $this->headOffice = $headOffice;

        return $this;
    }

    public function getNumberEmployees(): ?int
    {
        return $this->numberEmployees;
    }

    public function setNumberEmployees(int $numberEmployees): self
    {
        $this->numberEmployees = $numberEmployees;

        return $this;
    }

    /**
     * @return Collection<int, Car>
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars->add($car);
            $car->setTeam($this);
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getTeam() === $this) {
                $car->setTeam(null);
            }
        }

        return $this;
    }
}
