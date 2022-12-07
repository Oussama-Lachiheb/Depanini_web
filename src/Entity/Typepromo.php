<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Typepromo
 *
 * @ORM\Table(name="typepromo")
 * @ORM\Entity(repositoryClass="App\Repository\TypePromoRepository")
 */
class Typepromo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_type", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idType;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    #[Assert\NotNull]
    private $description;

    public function getIdType(): ?int
    {
        return $this->idType;
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


}
