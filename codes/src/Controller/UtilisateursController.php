<?php


namespace App\Controller;


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
     * @Route("", name="main_index")
     */
    public function indexAction(): Response
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route(
     *     "/ajouterendur",
     *     name="utilisateurs_ajouterendur"
     * )
     */
    public function utilisateursAjouterEnDur(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $user = new Utilisateurs();
        $user->setLogin("admin")
            ->setMdp(sha1("nimda"))
            ->setNom("admin")
            ->setPrenom("admin")
            ->setDateN(new \DateTime('1970-07-01'))
            ->setIsAdmin(true);
        $em->persist($user);
        $em->flush();
        dump($user);

        return new Response("<body>All good!<body/>");
    }
}