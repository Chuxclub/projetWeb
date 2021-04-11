<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\Produit;
use App\Entity\Utilisateur;
use App\Service\GlobalUserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/paniers")
 */
class PaniersController extends AbstractController
{
    private $em;
    private $user;

    public function __construct(GlobalUserService $globalUser, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->user = $globalUser->getGlobalUser();

        //Seuls les clients peuvent accéder à l'ensemble des méthodes de ce contrôleur:
        $globalUser->checkUser($this->user, "client");
    }

    /* =============================================================
     *                          AJOUTS
     * ============================================================= */

    /**
     * @Route(
     *      "/ajouterEnDur",
     *      name="panier_ajouterendur"
     * )
     */
    public function panierAjouterEnDurAction(): Response
    {
        //On prend un utilisateur (on pourrait prendre n'importe lequel mais on choisit
        // l'utilisateur courant ici pour pouvoir tester rapidement dans un navigateur) :
        $userLogin = $this->getParameter('login');
        $utilisateursRepository = $this->em->getRepository('App:Utilisateur');
        /** @var Utilisateur $user */
        $user = $utilisateursRepository->findOneBy(['login' => $userLogin]);

        //On prend un produit:
        $produitsRepository = $this->em->getRepository('App:Produit');
        /** @var Produit $produit */
        $produit = $produitsRepository->find(2);//TLZ Majora's Mask

        //On crée le panier + ajout à la base:
        $panier = new Panier();
        $panier->setUtilisateur($user)
            ->setProduit($produit)
            ->setQte(3);
        $this->em->persist($panier);
        $this->em->flush();

        return new Response("<body>Basket all good!</body>");
    }

    /**
     * @Route(
     *     "/ajoutPanier",
     *     name="panier_ajoutPanier"
     * )
     */
    public function ajoutPanierAction(): Response
    {
        $produitsRepository = $this->em->getRepository('App:Produit');
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
                    /** @var Produit $produit */

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


    /* =============================================================
     *                          LECTURE
     * ============================================================= */

    /**
     * @Route(
     *      "/contenu",
     *      name="contenu_panier"
     * )
     */
    public function contenuPanierAction(): Response
    {
        $paniers = $this->user->getPaniers();
        return $this->render('Utilisateurs/Clients/basket.html.twig', ['paniers' => $paniers]);
    }



    /* =============================================================
     *                          SUPPRESSION
     * ============================================================= */

    /**
     * @Route(
     *     "/acheter",
     *      name="acheter_panier"
     * )
     */
    public function acheterAction(): Response
    {
        //On récupère l'utilisateur global de la base et son panier:
        $paniers = $this->user->getPaniers();

        //On supprime tout:
        $paniersLen = $paniers->count();
        for($i = 0; $i < $paniersLen; $i++)
            $this->supprimerPanier($paniers[$i]);

        //On redirige:
        return $this->redirectToRoute("contenu_panier");
    }

    private function supprimerPanier($panierToDelete)
    {
        $this->em->persist($panierToDelete);
        $this->em->remove($panierToDelete);
        $this->em->flush();
    }

    private function supprimerPanierBD($idProduit, $panierToDelete)
    {
        //On récupère modifie la quantité du produit correspondant dans la base du magasin:
        $produitsRepository = $this->em->getRepository('App\Entity\Produit');
        /** @var Produit $produit */
        $produit = $produitsRepository->find($idProduit);
        $produit->setQte($produit->getQte() + $panierToDelete->getQte());

        //On supprime le panier:
        $this->supprimerPanier($panierToDelete);
    }

    /**
     * @Route(
     *     "/supprimerPanier/{idProduit}",
     *      name="supprimer_panier"
     * )
     */
    public function supprimerPanierAction($idProduit): Response
    {
        //On recherche le panier à supprimer:
        $paniersRepository = $this->em->getRepository('App:Panier');
        /** @var Panier $panier */
        $panierToDelete = $paniersRepository->findOneBy(['utilisateur' => $this->user, 'produit' => $idProduit]);

        //On supprime:
        $this->supprimerPanierBD($idProduit, $panierToDelete);

        //On redirige:
        return $this->redirectToRoute("contenu_panier");
    }

    /**
     * @Route(
     *     "/viderPanier",
     *      name="vider_panier"
     * )
     */
    public function viderPaniersAction(): Response
    {
        //On récupère l'utilisateur global de la base et son panier:
        $paniers = $this->user->getPaniers();

        //On supprime tout:
        $paniersLen = $paniers->count();
        for($i = 0; $i < $paniersLen; $i++)
            $this->supprimerPanierBD($paniers[$i]->getProduit()->getId(), $paniers[$i]);

        //On redirige:
        return $this->redirectToRoute("contenu_panier");
    }
}