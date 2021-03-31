<?php


namespace App\Controller\Utilisateurs;


use App\Entity\Utilisateurs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/utilisateurs")
 */
class UtilisateursController extends AbstractController
{
    /**
     * @Route(
     *     "/ajouterendur",
     *     name="utilisateurs_ajouterendur"
     * )
     */
    public function utilisateursAjouterEnDurAction(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $user = new Utilisateurs();
        $user->setLogin("dummy")
            ->setMdp(sha1("ymmud"))
            ->setDateN(new \DateTime('2021-03-31'))
            ->setIsAdmin(false);
        $em->persist($user);
        $em->flush();
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