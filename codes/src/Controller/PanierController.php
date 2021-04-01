<?php


namespace App\Controller;


use App\Entity\Panier;
use App\Entity\Produits;
use App\Entity\Utilisateurs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/panier")
 */
class PanierController extends AbstractController
{
    /**
     * @Route(
     *      "/ajouterendur",
     *      name="panier_ajouterendur"
     * )
     */
    public function panierAjouterEnDurAction(): Response
    {
        $em = $this->getDoctrine()->getManager();

        //On prend un utilisateur (on pourrait prendre n'importe lequel mais on choisit
        // l'utilisateur courant ici pour pouvoir tester rapidement dans un navigateur) :
        $userLogin = $this->getParameter('login');
        $utilisateursRepository = $em->getRepository('App:Utilisateurs');
        /** @var Utilisateurs $user */
        $user = $utilisateursRepository->findOneBy(['login' => $userLogin]);

        //On prend un produit:
        $produitsRepository = $em->getRepository('App:Produits');
        /** @var Produits $produit */
        $produit = $produitsRepository->find(2);//TLZ Majora's Mask

        //On crée le panier + ajout à la base:
        $panier = new Panier();
        $panier->setUtilisateur($user)
            ->setProduit($produit)
            ->setQte(15);
        $em->persist($panier);
        $em->flush();
        dump($panier);

        return new Response("<body>Basket all good!</body>");
    }
}