<?php


namespace App\Controller;


use App\Entity\Panier;
use App\Entity\Produits;
use App\Entity\Utilisateurs;
use App\Service\GlobalUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/panier")
 */
class PanierController extends AbstractController
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
     *      "/ajouterendur",
     *      name="panier_ajouterendur"
     * )
     */
    public function panierAjouterEnDurAction(): Response
    {
        //On prend un utilisateur (on pourrait prendre n'importe lequel mais on choisit
        // l'utilisateur courant ici pour pouvoir tester rapidement dans un navigateur) :
        $userLogin = $this->getParameter('login');
        $utilisateursRepository = $this->em->getRepository('App:Utilisateurs');
        /** @var Utilisateurs $user */
        $user = $utilisateursRepository->findOneBy(['login' => $userLogin]);

        //On prend un produit:
        $produitsRepository = $this->em->getRepository('App:Produits');
        /** @var Produits $produit */
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
}