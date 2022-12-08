<?php

namespace App\Entity;

use App\Repository\RateRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: RateRepository::class)]

class Rate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;


    #[Assert\NotNull]
    #[Assert\LessThanOrEqual(
        value: 5,
    )]
    #[ORM\Column]
    #[Assert\Positive]
    private ?float $rate;

    #[ORM\ManyToOne(inversedBy: 'rate')]
    private ?Client $idClient=null;

    #[ORM\ManyToOne(inversedBy: 'ratee')]
    private ?Prestataire $idPrestataire=null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getIdClient(): ?Client
    {
        return $this->idClient;
    }

    public function setIdClient(?Client $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }

    public function getIdPrestataire(): ?Prestataire
    {
        return $this->idPrestataire;
    }

    public function setIdPrestataire(?Prestataire $idPrestataire): self
    {
        $this->idPrestataire = $idPrestataire;

        return $this;
    }

}
