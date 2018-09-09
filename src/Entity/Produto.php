<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProdutoRepository")
 */
class Produto
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="category_id")
     */
    private $category_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ListProducts", mappedBy="produto")
     */
    private $listProducts;

    public function __construct()
    {
        $this->listProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }
    
    public function getCategoryId(): ?Category
    {
        return $this->category_id;
    }

    public function setCategoryId(?Category $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * @return Collection|ListProducts[]
     */
    public function getListProducts(): Collection
    {
        return $this->listProducts;
    }

    public function addListProduct(ListProducts $listProduct): self
    {
        if (!$this->listProducts->contains($listProduct)) {
            $this->listProducts[] = $listProduct;
            $listProduct->setProduto($this);
        }

        return $this;
    }

    public function removeListProduct(ListProducts $listProduct): self
    {
        if ($this->listProducts->contains($listProduct)) {
            $this->listProducts->removeElement($listProduct);
            // set the owning side to null (unless already changed)
            if ($listProduct->getProduto() === $this) {
                $listProduct->setProduto(null);
            }
        }

        return $this;
    }
}
