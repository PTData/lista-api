<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
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
     * @ORM\OneToMany(targetEntity="App\Entity\Lista", mappedBy="user_id")
     */
    private $date_update;

    public function __construct()
    {
        $this->date_update = new ArrayCollection();
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

    /**
     * @return Collection|Lista[]
     */
    public function getDateUpdate(): Collection
    {
        return $this->date_update;
    }

    public function addDateUpdate(Lista $dateUpdate): self
    {
        if (!$this->date_update->contains($dateUpdate)) {
            $this->date_update[] = $dateUpdate;
            $dateUpdate->setUserId($this);
        }

        return $this;
    }

    public function removeDateUpdate(Lista $dateUpdate): self
    {
        if ($this->date_update->contains($dateUpdate)) {
            $this->date_update->removeElement($dateUpdate);
            // set the owning side to null (unless already changed)
            if ($dateUpdate->getUserId() === $this) {
                $dateUpdate->setUserId(null);
            }
        }

        return $this;
    }
}
