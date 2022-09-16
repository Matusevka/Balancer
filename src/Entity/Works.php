<?php

namespace App\Entity;

use App\Repository\WorksRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorksRepository::class)]
class Works
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $count_process = null;

    #[ORM\Column(nullable: true)]
    private ?int $nucleus = null;

    #[ORM\Column(nullable: true)]
    private ?int $memory = null;

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

    public function getCountProcess(): ?int
    {
        return $this->count_process;
    }

    public function setCountProcess(int $count_process): self
    {
        $this->count_process = $count_process;

        return $this;
    }

    public function getNucleus(): ?int
    {
        return $this->nucleus;
    }

    public function setNucleus(?int $nucleus): self
    {
        $this->nucleus = $nucleus;

        return $this;
    }

    public function getMemory(): ?int
    {
        
        return  $this->memory;
    }

    public function setMemory(?int $memory): self
    {
        $this->memory = $memory;

        return $this;
    }
}
