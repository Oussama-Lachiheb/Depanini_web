<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * Prestataire
 *
 * @ORM\Table(name="prestataire")
 * @ORM\Entity(repositoryClass="App\Repository\PrestataireRepository")
 */
class Prestataire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Prestataire", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPrestataire;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=25, nullable=false)
     */

    #[Assert\NotNull]
    private $nom;
    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=25, nullable=false)
     */
    #[Assert\NotNull]
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="localisation", type="string", length=255, nullable=false)
     */
    #[Assert\NotNull]
    private $localisation;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="mot_de_passe", type="string", length=255, nullable=false)
     */
    #[Assert\NotNull]
    private $motDePasse;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_heure", type="float", precision=10, scale=0, nullable=false)
     */
    #[Assert\NotNull]
    private $prixHeure;

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
