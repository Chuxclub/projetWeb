<?php


namespace App\Controller;


use App\Entity\Panier;
use App\Entity\Produits;
use App\Service\GlobalUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/produits")
 */
class ProduitsController extends AbstractController
{
    private $em;
    private $user;

    public function __construct(GlobalUser $globalUser, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->user = $globalUser->getGlobalUser();
    }

    /**
     * @Route(
     *     "/ajouterendur",
     *     name="produits_ajouterendur"
     * )
     */
    public function produitsAjouterEnDurAction(): Response
    {
        $product = new Produits();
        $product->setLibelle("Zelda Majora's Mask")
                ->setPrixUnitaire(32)
                ->setQte(1);
        $this->em->persist($product);
        $this->em->flush();

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
        $produitsRepository = $this->em->getRepository('App\Entity\Produits');
        $produits = $produitsRepository->findAll();

        return $this->render('Produits/product_list.html.twig', ['produits' => $produits]);
    }

    /**
     * @Route(
     *     "/ajoutPanier",
     *     name="produits_ajoutPanier"
     * )
     */
    public function ajoutPanierAction(): Response
    {
        $produitsRepository = $this->em->getRepository('App:Produits');
        $paniersRepository = $this->em->getRepository('App:Panier');

        foreach($_POST as $idProduit => $qteProduit)
        {
            if($qteProduit > 0) {
                //On gère les produits dans la BD:
                $produit = $produitsRepository->find($idProduit);
                $produit->setQte($produit->getQte() - $qteProduit);

                //On gère les paniers de l'utilisateur:
                /** @var Panier $panierToAdd */
                $panierToAdd = $paniersRepository->findOneBy(['utilisateur' => $this->user, 'produit' => $idProduit]);
                if (is_null($panierToAdd)) {
                    $panier = new Panier();
                    /** @var Produits $produit */

                    $panier->setUtilisateur($this->user)
                        ->setQte($qteProduit)
                        ->setProduit($produit);

                    $this->em->persist($panier);
                } else
                    $panierToAdd->setQte($panierToAdd->getQte() + $qteProduit);
                $this->em->flush();
            }
        }

        return $this->redirectToRoute("produits_liste");
    }
}