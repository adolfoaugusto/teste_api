<?php

namespace App\Entity;

use App\Repository\TipoDocumentoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Documentos;

/**
 * @ORM\Entity(repositoryClass=TipoDocumentoRepository::class)
 */
class TipoDocumento
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
    private $nome_tipo;

    /**
     * @ORM\OneToMany(targetEntity=Documentos::class, mappedBy="tipo_id")
     */
    private $documentos;

    public function __construct()
    {
        $this->documentos = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeTipo(): ?string
    {
        return $this->nome_tipo;
    }

    public function setNomeTipo(string $nome_tipo): self
    {
        $this->nome_tipo = $nome_tipo;

        return $this;
    }

    /**
     * @return Collection|Documentos[]
     */
    public function getDocumentos(): Collection
    {
        return $this->documentos;
    }

    public function addDocumento(Documentos $documento): self
    {
        if (!$this->documentos->contains($documento)) {
            $this->documentos[] = $documento;
            $documento->setTipoId($this);
        }

        return $this;
    }

    public function removeDocumento(Documentos $documento): self
    {
        if ($this->documentos->removeElement($documento)) {
            // set the owning side to null (unless already changed)
            if ($documento->getTipoId() === $this) {
                $documento->setTipoId(null);
            }
        }

        return $this;
    }
}
