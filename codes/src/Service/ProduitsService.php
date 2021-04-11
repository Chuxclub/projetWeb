<?php

namespace App\Service;

class ProduitsService
{
    public function getAllProducts($em) : array
    {
        $produitsRepository = $em->getRepository('App\Entity\Produits');
        $produits = $produitsRepository->findAll();

        return $produits;
    }

    public function getNbProducts($em): int
    {
        $produits = $this->getAllProducts($em);

        $totalProduits = 0;
        for($i = 0; $i < count($produits); $i++)
            $totalProduits += $produits[$i]->getQte();

        return $totalProduits;
    }
}