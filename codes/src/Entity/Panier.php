<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table (
 *     name="im2021_panier",
 *     options={"comment"="Panier de l'utilisateur (jointure entre utilisateurs et produits)"},
 *     )
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 */
class Panier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="pk")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $qte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(int $qte): self
    {
        $this->qte = $qte;

        return $this;
    }
}
