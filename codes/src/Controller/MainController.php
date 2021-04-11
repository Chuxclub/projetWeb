<?php

namespace App\Controller;

use App\Service\GlobalUserService;
use App\Service\ProduitsService;
use App\Service\SecretService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/main")
 */
class MainController extends AbstractController
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
     * @Route("", name="main_index")
     */
    public function indexAction(SecretService $secretService): Response
    {
        $message = $secretService->getReverseMessage();
        $this->addFlash('info', $message);
        return $this->render('Layouts/index.html.twig');
    }

    public function getMenu(ProduitsService $produitsService): Response
    {
        $args = ['totalProduits' => $produitsService->getNbProducts($this->em),
                 'user' => $this->user];
        return $this->render('Layouts/menu.html.twig', $args);
    }

    public function getHeader(): Response
    {
        $args = ['user' => $this->user];
        return $this->render('Layouts/header.html.twig', $args);
    }
}

/* ====================================================================================== */
/* AUTEURS: Amandine Fradet, Florian Legendre                                             */
/* ====================================================================================== */
