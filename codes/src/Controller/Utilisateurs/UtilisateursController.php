<?php

namespace App\Controller\Utilisateurs;

use App\Entity\Utilisateur;
use App\Service\GlobalUserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/utilisateurs")
 */
class UtilisateursController extends AbstractController
{
    private $em;
    private $user;

    public function __construct(GlobalUserService $globalUser, EntityManagerInterface $entityManager)
    {
        //Peu importe l'utilisateur, ils doivent pouvoir accéder à l'ensemble des méthodes de ce
        //contrôleur donc pas de protection:
        $this->em = $entityManager;
        $this->user = $globalUser->getGlobalUser();
    }

    /**
     * @Route(
     *     "/ajouterEnDur",
     *     name="utilisateurs_ajouterendur"
     * )
     */
    public function utilisateursAjouterEnDurAction(): Response
    {
        $user = new Utilisateur();
        $user->setLogin("dummy")
            ->setMdp(sha1("ymmud"))
            ->setDateN(new \DateTime('2021-03-31'))
            ->setIsAdmin(false);
        $this->em->persist($user);
        $this->em->flush();
        dump($user);

        return new Response("<body>User all good!</body>");
    }

    /**
     * @Route(
     *     "/deconnexion",
     *     name="utilisateurs_deconnexion"
     * )
     */
    public function disconnectAction(): Response
    {
        $this->addFlash('info', "You've been disconnected. Good bye!");
        return $this->redirectToRoute("main_index");
    }
}