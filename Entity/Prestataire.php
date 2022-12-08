<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: PrestataireRepository::class)]
class Prestataire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idPrestataire;


    #[ORM\Column(length: 255)]
    private ?string $nom = null;
    #[Assert\NotNull]

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;
    #[Assert\NotNull]


    #[ORM\Column(length: 255)]
    private ?string $localisation = null;
    #[Assert\NotNull]

    #[ORM\Column(length: 255)]
    private ?string $email = null;
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]


    #[ORM\Column(length: 255)]
    private ?string $motDePasse = null;
    #[Assert\NotNull]


    #[ORM\Column]
    private ?float $prixHeure = null;
    #[Assert\NotNull]




    public function getIdPrestataire(): ?int
    {
        return $this->idPrestataire;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getPrixHeure(): ?float
    {
        return $this->prixHeure;
    }

    public function setPrixHeure(float $prixHeure): self
    {
        $this->prixHeure = $prixHeure;

        return $this;
    }


}
