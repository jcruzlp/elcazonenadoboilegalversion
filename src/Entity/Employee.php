<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    /**
     * @var Collection<int, EmployeeSkill>
     */
    #[ORM\OneToMany(targetEntity: EmployeeSkill::class, mappedBy: 'employee', orphanRemoval: true)]
    private Collection $skill;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
        $this->skill = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return Collection<int, EmployeeSkill>
     */
    public function getSkill(): Collection
    {
        return $this->skill;
    }

    public function addSkill(EmployeeSkill $skill): static
    {
        if (!$this->skill->contains($skill)) {
            $this->skill->add($skill);
            $skill->setEmployee($this);
        }

        return $this;
    }

    public function removeSkill(EmployeeSkill $skill): static
    {
        if ($this->skill->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if ($skill->getEmployee() === $this) {
                $skill->setEmployee(null);
            }
        }

        return $this;
    }


}
