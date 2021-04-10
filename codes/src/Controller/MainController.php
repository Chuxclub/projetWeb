<?php

namespace App\Controller;


use App\Entity\Produits;
use App\Service\GlobalUser;
use App\Service\SecretService;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
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

    public function __construct(GlobalUser $globalUser, EntityManagerInterface $entityManager)
    {
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

    public function getMenu(): Response
    {
        $produitsRepository = $this->em->getRepository('App:Produits');
        /** @var Produits[] $produits */
        $produits = $produitsRepository->findAll();

        $totalProduits = 0;
        for($i = 0; $i < count($produits); $i++)
            $totalProduits += $produits[$i]->getQte();

        $args = array('totalProduits' => $totalProduits, 'user' => $this->user);
        return $this->render('Layouts/menu.html.twig', $args);
    }

    public function getHeader(): Response
    {
        $args = array('user' => $this->user);
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
