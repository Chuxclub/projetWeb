<?php


namespace App\Controller\Utilisateurs;


use App\Entity\Panier;
use App\Entity\Produit;
use App\Form\ClientProfilType;
use App\Service\GlobalUserService;
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

    public function __construct(GlobalUserService $globalUser, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->user = $globalUser->getGlobalUser();

        //Seuls les clients peuvent accéder à l'ensemble des méthodes de ce contrôleur:
        $globalUser->checkUser($this->user, "client");
    }

    /**
     * @Route(
     *      "/editProfil",
     *      name="clients_editProfil"
     * )
     */
    public function editProfil(Request $request, GlobalUserService $globalUser): Response
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
        return $this->render('Utilisateurs/Clients/manage_profil.html.twig', $args);
    }
}

/* ====================================================================================== */
/* AUTEURS: Amandine Fradet, Florian Legendre                                             */
/* ====================================================================================== */