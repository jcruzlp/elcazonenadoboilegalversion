<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Skill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(type: 'integer')]
    private int $junior;

    #[ORM\Column(type: 'integer')]
    private int $senior;

    #[ORM\Column(type: 'integer')]
    private int $expert;

    #[ORM\ManyToOne(inversedBy: 'skills')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profile $profile = null;

    public function getId(): ?int { return $this->id; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }

    public function getJunior(): int { return $this->junior; }
    public function setJunior(int $junior): self { $this->junior = $junior; return $this; }

    public function getSenior(): int { return $this->senior; }
    public function setSenior(int $senior): self { $this->senior = $senior; return $this; }

    public function getExpert(): int { return $this->expert; }
    public function setExpert(int $expert): self { $this->expert = $expert; return $this; }

    public function getProfile(): ?Profile { return $this->profile; }
    public function setProfile(?Profile $profile): self { $this->profile = $profile; return $this; }
}
