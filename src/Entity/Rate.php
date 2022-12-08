<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rate
 *
 * @ORM\Table(name="rate", indexes={@ORM\Index(name="id_Prestataire", columns={"id_Prestataire"}), @ORM\Index(name="Id_Client", columns={"Id_Client"})})
 * @ORM\Entity
 */
class Rate
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="rate", type="float", precision=10, scale=0, nullable=false)
     */
    private $rate;

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
