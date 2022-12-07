<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service", indexes={@ORM\Index(name="id_Prestataire", columns={"id_Prestataire"})})
 * @ORM\Entity
 */
class Service
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_service", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idService;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255, nullable=false)
     */
    private $categorie;

    /**
     * @var \Prestataire
     *
     * @ORM\ManyToOne(targetEntity="Prestataire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Prestataire", referencedColumnName="id_Prestataire")
     * })
     */
    private $idPrestataire;

    public function getIdService(): ?int
    {
        return $this->idService;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

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
