<?php


namespace App\Controller\Utilisateurs;


use App\Entity\Produits;
use App\Entity\Utilisateurs;
use App\Form\ClientProfilType;
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
    /**
     * @Route(
     *      "/editProfil",
     *      name="clients_editProfil"
     * )
     */
    public function editProfil(Request $request): Response
    {
        //On récupère l'utilisateur global de la base:
        $userLogin = $this->getParameter('login');
        $em = $this->getDoctrine()->getManager();
        $utilisateursRepository = $em->getRepository('App:Utilisateurs');
        /** @var Utilisateurs $user */
        $user = $utilisateursRepository->findOneBy(['login' => $userLogin]);

        //On crée le formulaire:
        $form = $this->createForm(ClientProfilType::class, $user);
        $form->add('send', SubmitType::class, ['label' => 'Editer le Profil']);

        //On gère le formulaire:
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            try {
                $em->flush();
                $this->addFlash('info', "Your profile has been edited!");
                return $this->redirectToRoute('main_index');
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


    /**
     * @Route(
     *      "/panier",
     *      name="clients_panier"
     * )
     */
    //TODO: La vue et l'action doivent être adaptée à l'objectif de l'action
    public function contenuPanierAction(): Response
    {
        $em = $this->getDoctrine()->getManager();

        //On récupère l'utilisateur global de la base et son panier:
        $userLogin = $this->getParameter('login');
        $utilisateursRepository = $em->getRepository('App:Utilisateurs');
        /** @var Utilisateurs $user */
        $user = $utilisateursRepository->findOneBy(['login' => $userLogin]);
        $paniers = $user->getPaniers();

        //On récupère les produits de la base:
        $produitsRepository = $em->getRepository('App\Entity\Produits');
        /** @var Produits[] $produits */
        $produits = $produitsRepository->findAll();

        //On fait la jointure:
        $jointure = [];
        $qteTotale = 0;
        $prixTotal = 0;
        for($i = 0; $i < $paniers->count(); $i++)
        {
            $prixCommande = $paniers[$i]->getProduit()->getPrixUnitaire()*$paniers[$i]->getQte();
            $jointure[$i] =
                [
                    $paniers[$i]->getProduit()->getLibelle(),
                    $paniers[$i]->getProduit()->getPrixUnitaire(),
                    $paniers[$i]->getProduit()->getQte(),
                    $prixCommande,
                    $paniers[$i]->getProduit()->getId()
                ];
            $qteTotale += $paniers[$i]->getQte();
            $prixTotal += $prixCommande;
        }

        return $this->render('Utilisateurs/Client/basket.html.twig',
            ['jointure' => $jointure, 'qteTotale' => $qteTotale, 'prixTotal' => $prixTotal]);
    }

    /**
     * @Route(
     *      name="update_panier"
     * )
     */
    public function updatePanierAction(): Response
    {
        return $this->redirectToRoute("clients_panier");
    }
}