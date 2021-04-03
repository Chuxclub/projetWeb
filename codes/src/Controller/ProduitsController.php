<?php


namespace App\Controller;


use App\Entity\Produits;
use App\Service\GlobalUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/produits")
 */
class ProduitsController extends AbstractController
{
    private $em;
    private $user;

    public function __construct(GlobalUser $globalUser, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->user = $globalUser->getGlobalUser();
    }

    /**
     * @Route(
     *     "/ajouterendur",
     *     name="produits_ajouterendur"
     * )
     */
    public function produitsAjouterEnDurAction(): Response
    {
        $product = new Produits();
        $product->setLibelle("Zelda Majora's Mask")
                ->setPrixUnitaire(32)
                ->setQte(1);
        $this->em->persist($product);
        $this->em->flush();
        dump($product);

        return new Response("<body>Product all good!</body>");
    }

    /**
     * @Route(
     *     "/liste",
     *     name="produits_liste"
     * )
     */
    public function produitsListerAction(): Response
    {
        $produitsRepository = $this->em->getRepository('App\Entity\Produits');
        $produits = $produitsRepository->findAll();

        return $this->render('Produits/product_list.html.twig', ['produits' => $produits]);
    }
}