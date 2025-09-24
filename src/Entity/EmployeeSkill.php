<?php

namespace App\Entity;

use App\Repository\EmployeeSkillRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeSkillRepository::class)]
class EmployeeSkill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'skill')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employee $employee = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Skill $skill = null;

    #[ORM\Column(length: 25)]
    private ?string $level = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): static
    {
        $this->employee = $employee;

        return $this;
    }

    public function getSkill(): ?Skill
    {
        return $this->skill;
    }

    public function setSkill(?Skill $skill): static
    {
        $this->skill = $skill;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): static
    {
        $this->level = $level;

        return $this;
    }
}
