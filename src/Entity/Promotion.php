<?php

namespace App\Entity;
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
    /**
     * @var int
     *
     * @ORM\Column(name="id_promo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPromo;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_heure_pres", type="float", precision=10, scale=0, nullable=false)
     */
    #[Assert\NotNull]

    private $prixHeurePres;

    /**
     * @var int
     *
     * @ORM\Column(name="taux_promo", type="integer", nullable=false)
     */
    #[Assert\NotNull]

    private $tauxPromo;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_heure_final", type="float", precision=10, scale=0, nullable=false)
     */
    #[Assert\NotNull]

    private $prixHeureFinal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debu_promo", type="date", nullable=false)
     */
    #[Assert\NotNull]

    private $dateDebuPromo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin_promo", type="date", nullable=false)
     */
    #[Assert\NotNull]

    private $dateFinPromo;

    /**
     * @var \Typepromo
     *
     * @ORM\ManyToOne(targetEntity="Typepromo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type", referencedColumnName="id_type")
     * })
     */
    private $idType;

    /**
     * @var \Service
     *
     * @ORM\ManyToOne(targetEntity="Service")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_service", referencedColumnName="id_service")
     * })
     */
    private $idService;

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
