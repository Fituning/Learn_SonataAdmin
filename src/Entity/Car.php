<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
#[ORM\Table(name: "race__car")]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

    #[ORM\Column]
    private ?int $power = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $team = null;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: Pilote::class, cascade:["persist", "remove"])]
    private Collection $pilotes;

//    #[ORM\OneToOne(inversedBy: 'car', targetEntity: Pilote::class, cascade: ['persist'])]
//    private ?Pilote $pilote = null;


    public function __construct()
    {
        $this->pilotes = new ArrayCollection();
    }


    public function __toString() : string
    {
//        return (string) "Car Number :" . $this->pilotes?->getNumber() . " || " . $this->power . " HP";
        if($this->pilotes->isEmpty()){
            return (string) $this->team->getName() . " Team car || ";
        }else{
            $pilotes = null;
            foreach ($this->pilotes as $p){
                $pilotes = $pilotes .$p."  ";
            }
            return (string) "Car driven by :" . $pilotes ;
        }

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(int $power): self
    {
        $this->power = $power;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }

//    public function getPilote(): ?Pilote
//    {
//        return $this->pilote;
//    }
//
//    public function setPilote(?Pilote $pilote): self
//    {
//        // unset the owning side of the relation if necessary
//        if ($pilote === null && $this->pilote !== null) {
//            $this->pilote->setCar(null);
//        }
//
//        // set the owning side of the relation if necessary
//        if ($pilote !== null && $pilote->getCar() !== $this) {
//            $pilote->setCar($this);
//        }
//
//        $this->pilote = $pilote;
//
//        return $this;
//    }

    /**
     * @return Collection<int, Pilote>
     */
    public function getPilotes(): Collection
    {
        return $this->pilotes;
    }

    public function addPilote(Pilote $pilote): self
    {
        if (!$this->pilotes->contains($pilote)) {
            $this->pilotes->add($pilote);
            $pilote->setCar($this);
        }

        return $this;
    }

    public function removePilote(Pilote $pilote): self
    {
        if ($this->pilotes->removeElement($pilote)) {
            // set the owning side to null (unless already changed)
            if ($pilote->getCar() === $this) {
                $pilote->setCar(null);
            }
        }

        return $this;
    }
}
