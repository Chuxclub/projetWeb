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
        $user->setLogin("darkRider86")
            ->setMdp(sha1("nivek"))
            ->setDateN(new \DateTime('2008-07-25'))
            ->setIsAdmin(false);
        $em->persist($user);
        $em->flush();
        dump($user);

        return new Response("<body>User all good!</body>");
    }
}