<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typereclamation
 *
 * @ORM\Table(name="typereclamation")
 * @ORM\Entity
 */
class Typereclamation
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
