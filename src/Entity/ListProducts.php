<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ListProductsRepository")
 */
class ListProducts
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lista", mappedBy="produto_id")
     */
    private $list;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produto", inversedBy="listProducts", cascade={"persist"})
     */
    private $produto;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lista", inversedBy="listProducts", cascade={"persist"})
     */
    private $lista;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $unidades;

    public function __construct()
    {
        $this->list = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Lista[]
     */
    public function getList(): Collection
    {
        return $this->list;
    }

    public function addList(Lista $list): self
    {
        if (!$this->list->contains($list)) {
            $this->list[] = $list;
            $list->setProdutoId($this);
        }

        return $this;
    }

    public function removeList(Lista $list): self
    {
        if ($this->list->contains($list)) {
            $this->list->removeElement($list);
            // set the owning side to null (unless already changed)
            if ($list->getProdutoId() === $this) {
                $list->setProdutoId(null);
            }
        }

        return $this;
    }

    public function getProduto(): ?Produto
    {
        return $this->produto;
    }

    public function setProduto(?Produto $produto): self
    {
        $this->produto = $produto;

        return $this;
    }

    public function getLista(): ?Lista
    {
        return $this->lista;
    }

    public function setLista(?Lista $lista): self
    {
        $this->lista = $lista;

        return $this;
    }

    public function getUnidades(): ?int
    {
        return $this->unidades;
    }

    public function setUnidades(?int $unidades): self
    {
        $this->unidades = $unidades;

        return $this;
    }
}
