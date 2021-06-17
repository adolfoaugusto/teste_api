<?php

namespace App\Entity;

use App\Repository\DocumentosRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\TipoDocumento;

/**
 * @ORM\Entity(repositoryClass=DocumentosRepository::class)
 */
class Documentos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=TipoDocumento::class, inversedBy="documentos")
     */
    private $tipo_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titulo;

    /**
     * @ORM\Column(type="string", length=255)
    */
    private $nome_arquivo;

    // public function __construct($tipo_id, $titulo, $nome_arquivo) {
    //     $this->tipo_id = $tipo_id;
    //     $this->titulo = $titulo;
    //     $this->nome_arquivo = $nome_arquivo;
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipoId(): ?TipoDocumento
    {
        return $this->tipo_id;
    }

    public function setTipoId(TipoDocumento $tipo_id): self
    {
        $this->tipo_id = $tipo_id;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getNomeArquivo(): ?string
    {
        return $this->nome_arquivo;
    }

    public function setNomeArquivo(string $nome_arquivo): self
    {
        $this->nome_arquivo = $nome_arquivo;

        return $this;
    }

    public function __toString() {
        return $this->nome_arquivo;
    }
}
