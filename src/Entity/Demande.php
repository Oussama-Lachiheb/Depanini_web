<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table(name="demande", indexes={@ORM\Index(name="id_service", columns={"id_service"}), @ORM\Index(name="id_Prestataire", columns={"id_Prestataire"}), @ORM\Index(name="Id_Client", columns={"Id_Client"})})
 * @ORM\Entity
 */
class Demande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_demande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDemande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_demande", type="date", nullable=false)
     */
    private $dateDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="description_demande", type="string", length=255, nullable=false)
     */
    private $descriptionDemande;

    /**
     * @var int
     *
     * @ORM\Column(name="Id_Categorie", type="integer", nullable=false)
     */
    private $idCategorie;

    /**
     * @var \Service
     *
     * @ORM\ManyToOne(targetEntity="Service")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_service", referencedColumnName="id_service")
     * })
     */
    private $idService;

    /**
     * @var \Prestataire
     *
     * @ORM\ManyToOne(targetEntity="Prestataire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Prestataire", referencedColumnName="id_Prestataire")
     * })
     */
    private $idPrestataire;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_Client", referencedColumnName="Id_Client")
     * })
     */
    private $idClient;

    public function getIdDemande(): ?int
    {
        return $this->idDemande;
    }

    public function getDateDemande(): ?\DateTimeInterface
    {
        return $this->dateDemande;
    }

    public function setDateDemande(\DateTimeInterface $dateDemande): self
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    public function getDescriptionDemande(): ?string
    {
        return $this->descriptionDemande;
    }

    public function setDescriptionDemande(string $descriptionDemande): self
    {
        $this->descriptionDemande = $descriptionDemande;

        return $this;
    }

    public function getIdCategorie(): ?int
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(int $idCategorie): self
    {
        $this->idCategorie = $idCategorie;

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

    public function getIdPrestataire(): ?Prestataire
    {
        return $this->idPrestataire;
    }

    public function setIdPrestataire(?Prestataire $idPrestataire): self
    {
        $this->idPrestataire = $idPrestataire;

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


}
