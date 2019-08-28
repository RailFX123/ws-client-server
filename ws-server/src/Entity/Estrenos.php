<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EstrenosRepository")
 */
class Estrenos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titulo;

    /**
     * @ORM\Column(type="integer")
     */
    private $year_salida;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url_trailer;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getYearSalida(): ?int
    {
        return $this->year_salida;
    }

    public function setYearSalida(int $year_salida): self
    {
        $this->year_salida = $year_salida;

        return $this;
    }

    public function getUrlTrailer(): ?string
    {
        return $this->url_trailer;
    }

    public function setUrlTrailer(string $url_trailer): self
    {
        $this->url_trailer = $url_trailer;

        return $this;
    }
}
