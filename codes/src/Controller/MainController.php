<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Service\GlobalUser;
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

    public function getMenu(GlobalUser $user): Response
    {
        $em = $this->getDoctrine()->getManager();
        $produitsRepository = $em->getRepository('App:Produits');
        /** @var Produits[] $produits */
        $produits = $produitsRepository->findAll();

        $totalProduits = 0;
        for($i = 0; $i < count($produits); $i++)
            $totalProduits += $produits[$i]->getQte();

        $args = array('totalProduits' => $totalProduits, 'user' => $user->getGlobalUser());
        return $this->render('Layouts/menu.html.twig', $args);
    }

    public function getHeader(GlobalUser $user): Response
    {
        $args = array('user' => $user->getGlobalUser());
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
