<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
   

    #[ORM\Column(length: 100)]
    private ?string $player_name = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2)]
    private ?string $height = null;

    #[ORM\Column]
    private ?int $weight = null;

    #[ORM\Column(length: 100)]
    private ?string $nationality = null;

    #[ORM\Column]
    private ?int $player_number = null;

    #[ORM\Column]
    private ?int $player_position = null;


    public function getPlayerName(): ?string
    {
        return $this->player_name;
    }

    public function setPlayerName(string $player_name): static
    {
        $this->player_name = $player_name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getHeight(): ?string
    {
        return $this->height;
    }

    public function setHeight(string $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getPlayerNumber(): ?int
    {
        return $this->player_number;
    }

    public function setPlayerNumber(int $player_number): static
    {
        $this->player_number = $player_number;

        return $this;
    }

    public function getPlayerPosition(): ?int
    {
        return $this->player_position;
    }

    public function setPlayerPosition(int $player_position): static
    {
        $this->player_position = $player_position;

        return $this;
    }

   
}