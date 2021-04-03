<?php


namespace App\Controller\Utilisateurs;


<<<<<<< HEAD
use App\Entity\Utilisateurs;
=======
use App\Entity\Panier;
use App\Entity\Produits;
>>>>>>> 8835208b3f3c66c61e1793b1a4ab87c7a702cfb1
use App\Form\ClientProfilType;
use App\Service\GlobalUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/clients")
 */
class ClientsController extends AbstractController
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
     *      "/editProfil",
     *      name="clients_editProfil"
     * )
     */
    public function editProfil(Request $request, GlobalUser $globalUser): Response
    {
        //On crée le formulaire:
        $form = $this->createForm(ClientProfilType::class, $this->user);
        $form->add('send', SubmitType::class, ['label' => 'Editer le Profil']);

        //On gère le formulaire:
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            try {
                $this->em->flush();
                $this->addFlash('info', "Your profile has been edited!");
                return $this->redirectToRoute('produits_liste');
            }

            //TODO : Si plusieurs champs pouvant être uniques? Si plusieurs types d'exceptions?
            catch(\Exception $e)
            {$form->addError(new FormError("Sorry! This login already exists."));}
        }

        if ($form->isSubmitted())
            $this->addFlash('error', 'Error in form');

        $args = array('myform' => $form->createView());
        return $this->render('Utilisateurs/Client/manage_profil.html.twig', $args);
    }
<<<<<<< HEAD
=======


    /**
     * @Route(
     *      "/panier",
     *      name="clients_panier"
     * )
     */
    public function contenuPanierAction(): Response
    {
        $paniers = $this->user->getPaniers();
        return $this->render('Utilisateurs/Client/basket.html.twig', ['paniers' => $paniers]);
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
        $produitsRepository = $this->em->getRepository('App\Entity\Produits');
        /** @var Produits $produit */
        $produit = $produitsRepository->find($idProduit);
        $produit->setQte($produit->getQte() + $panierToDelete->getQte());

        //On supprime le panier:
        $this->supprimerPanier($panierToDelete);
    }

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
        return $this->redirectToRoute("clients_panier");
    }

    /**
     * @Route(
     *     "/empty_panier",
     *      name="empty_panier"
     * )
     */
    public function viderPanierAction(): Response
    {
        //On récupère l'utilisateur global de la base et son panier:
        $paniers = $this->user->getPaniers();

        //On supprime tout:
        $paniersLen = $paniers->count();
        for($i = 0; $i < $paniersLen; $i++)
            $this->supprimerPanierBD($paniers[$i]->getProduit()->getId(), $paniers[$i]);

        //On redirige:
        return $this->redirectToRoute("clients_panier");
    }

    /**
     * @Route(
     *     "/remove_panier/{idProduit}",
     *      name="remove_panier"
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
        return $this->redirectToRoute("clients_panier");
    }
>>>>>>> 8835208b3f3c66c61e1793b1a4ab87c7a702cfb1
}