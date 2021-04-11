<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class ProduitsService
{
    public function getAllProducts(EntityManagerInterface $em) : array
    {
        $produitsRepository = $em->getRepository('App\Entity\Produits');
        $produits = $produitsRepository->findAll();

        return $produits;
    }

    public function getNbProducts(EntityManagerInterface $em): int
    {
        $produits = $this->getAllProducts($em);

        $totalProduits = 0;
        for($i = 0; $i < count($produits); $i++)
            $totalProduits += $produits[$i]->getQte();

        return $totalProduits;
    }
}