<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/main")
 */
class MainController extends AbstractController
{
    /**
     * @Route("", name="main_index")
     */
    public function indexAction(): Response
    {
        return $this->render('Layouts/index.html.twig');
    }

    public function getGlobalUser(): ?Utilisateurs
    {
        $userLogin = $this->getParameter('login');

        $em = $this->getDoctrine()->getManager();
        $utilisateursRepository = $em->getRepository('App:Utilisateurs');

        /** @var Utilisateurs $user */
        $user = $utilisateursRepository->findOneBy(['login' => $userLogin]);
        return $user;
    }

    public function getMenu(): Response
    {
        $args = array('user' => $this->getGlobalUser());
        return $this->render('Layouts/menu.html.twig', $args);
    }

    public function getHeader(): Response
    {
        $args = array('user' => $this->getGlobalUser());
        return $this->render('Layouts/header.html.twig', $args);
    }


    /**
     * @Route("/basket", name="basket")
     */
    public function basketAction(): Response
    {
        return $this->render('basket.html.twig');
    }
}
