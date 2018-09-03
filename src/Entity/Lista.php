<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ListaRepository")
 */
class Lista
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Date;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $check_list;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="date_update")
     */
    private $user_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_update;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ListProducts", inversedBy="list")
     */
    private $produto_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ListProducts", mappedBy="lista")
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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(?\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getCheckList(): ?int
    {
        return $this->check_list;
    }

    public function setCheckList(?int $check_list): self
    {
        $this->check_list = $check_list;

        return $this;
    }

    public function getUserId(): ?Users
    {
        return $this->user_id;
    }

    public function setUserId(?Users $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getDateUpdate(): ?\DateTimeInterface
    {
        return $this->date_update;
    }

    public function setDateUpdate(\DateTimeInterface $date_update): self
    {
        $this->date_update = $date_update;

        return $this;
    }

    public function getProdutoId(): ?ListProducts
    {
        return $this->produto_id;
    }

    public function setProdutoId(?ListProducts $produto_id): self
    {
        $this->produto_id = $produto_id;

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
            $listProduct->setLista($this);
        }

        return $this;
    }

    public function removeListProduct(ListProducts $listProduct): self
    {
        if ($this->listProducts->contains($listProduct)) {
            $this->listProducts->removeElement($listProduct);
            // set the owning side to null (unless already changed)
            if ($listProduct->getLista() === $this) {
                $listProduct->setLista(null);
            }
        }

        return $this;
    }
}
