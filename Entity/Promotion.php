<?php

namespace App\Entity;
use Cassandra\Date;
use Symfony\Component\Validator\Constraints as Assert;


use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Promotion
 *
 * @ORM\Table(name="promotion", indexes={@ORM\Index(name="id_type", columns={"id_type"}), @ORM\Index(name="id_service", columns={"id_service"})})
 * @ORM\Entity(repositoryClass="App\Repository\PromotionRepository")
 */
class Promotion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idPromo;

    #[ORM\Column]
    #[Assert\NotNull]

    private ?float $prixHeurePres;

    #[ORM\Column]

    #[Assert\NotNull]

    private $tauxPromo;

    #[ORM\Column]
    #[Assert\NotNull]

    private ?float $prixHeureFinal;

    #[ORM\Column]

    #[Assert\NotNull]

    private ?\DateTime $dateDebuPromo;

    #[ORM\Column]

    #[Assert\NotNull]

    private ?\DateTime $dateFinPromo;

    #[ORM\ManyToOne(inversedBy: 'TypePromo')]
    private ?Typepromo $idType=null;

    #[ORM\ManyToOne(inversedBy: 'service')]
    private ?Service  $idService=null;

    public function getIdPromo(): ?int
    {
        return $this->idPromo;
    }

    public function getPrixHeurePres(): ?float
    {
        return $this->prixHeurePres;
    }

    public function setPrixHeurePres(float $prixHeurePres): self
    {
        $this->prixHeurePres = $prixHeurePres;

        return $this;
    }

    public function getTauxPromo(): ?int
    {
        return $this->tauxPromo;
    }

    public function setTauxPromo(int $tauxPromo): self
    {
        $this->tauxPromo = $tauxPromo;

        return $this;
    }

    public function getPrixHeureFinal(): ?float
    {
        return $this->prixHeureFinal;
    }

    public function setPrixHeureFinal(float $prixHeureFinal): self
    {
        $this->prixHeureFinal = $prixHeureFinal;

        return $this;
    }

    public function getDateDebuPromo(): ?\DateTimeInterface
    {
        return $this->dateDebuPromo;
    }

    public function setDateDebuPromo(\DateTimeInterface $dateDebuPromo): self
    {
        $this->dateDebuPromo = $dateDebuPromo;

        return $this;
    }

    public function getDateFinPromo(): ?\DateTimeInterface
    {
        return $this->dateFinPromo;
    }

    public function setDateFinPromo(\DateTimeInterface $dateFinPromo): self
    {
        $this->dateFinPromo = $dateFinPromo;

        return $this;
    }

    public function getIdType(): ?Typepromo
    {
        return $this->idType;
    }

    public function setIdType(?Typepromo $idType): self
    {
        $this->idType = $idType;

        return $this;
    }

    public function getIdService(): ?Service
    {
        return $this->idService;
    }

    public function setIdService(?Service $idService): self
    {
        $this->idService = $idService;

        return $this;
    }


}
