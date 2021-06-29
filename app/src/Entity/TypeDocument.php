<?php

namespace App\Entity;

use App\Repository\TypeDocumentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeDocumentRepository::class)
 */
class TypeDocument
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name_type;
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameType(): ?string
    {
        return $this->name_type;
    }

    public function setNameType(string $name_type): self
    {
        $this->name_type = $name_type;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getNameType();
    }
}
