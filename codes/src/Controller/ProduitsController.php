<?php


namespace App\Controller;


use App\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/produits")
 */
class ProduitsController extends AbstractController
{
    /**
     * @Route(
     *     "/ajouterendur",
     *     name="produits_ajouterendur"
     * )
     */
    public function produitsAjouterEnDurAction(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $product = new Produits();
        $product->setLibelle("Zelda Majora's Mask")
                ->setPrixUnitaire(32)
                ->setQte(1);
        $em->persist($product);
        $em->flush();
        dump($product);

        return new Response("<body>Product all good!</body>");
    }

    /**
     * @Route(
     *     "/liste",
     *     name="produits_liste"
     * )
     */
    public function produitsListerAction(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $produitsRepository = $em->getRepository('App\Entity\Produits');
        $produits = $produitsRepository->findAll();

        return $this->render('Produits/product_list.html.twig', ['produits' => $produits]);
    }
}