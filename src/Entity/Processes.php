<?php

namespace App\Entity;

use App\Repository\ProcessesRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity(repositoryClass: ProcessesRepository::class)]
class Processes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $count_process = null;

    #[ORM\Column]
    private ?int $memory = null;

    #[ORM\Column]
    private ?int $del = 0;

    #[ManyToOne(targetEntity: "Works", fetch: "EAGER")]
    private ?Works $work;

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

    public function getMemory(): ?int
    {
        return $this->memory;
    }

    public function setMemory(int $memory): self
    {
        $this->memory = $memory;

        return $this;
    }
    
    public function getDel(): ?int
    {
        return $this->del;
    }

    public function setDel(int $del): self
    {
        $this->memory = $del;

        return $this;
    }

    public function getWork(): ?Works
    {
        return $this->work;
    }

    public function setWork(Works $work): self
    {
        $this->work = $work;

        return $this;
    }
}
