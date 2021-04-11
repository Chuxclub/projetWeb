<?php


namespace App\Controller;


use App\Entity\Panier;
use App\Entity\Produits;
use App\Entity\Utilisateurs;
use App\Form\AddProductType;
use App\Service\GlobalUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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

    /* =============================================================
     *                          AJOUTS
     * ============================================================= */

    /**
     * @Route(
     *     "/ajouterendur",
     *     name="produits_ajouterendur"
     * )
     */
    public function produitsAjouterEnDurAction(): Response
    {
        //Cette action servait essentiellement au développement du site (peupler la base)
        //et n'est donc pas protégée car ne correspond à aucun utilisateur du cahier des charges.
        //On fait donc directement l'action:
        $product = new Produits();
        $product->setLibelle("Zelda Majora's Mask")
                ->setPrixUnitaire(32)
                ->setQte(1);
        $this->em->persist($product);
        $this->em->flush();

        return new Response("<body>Product all good!</body>");
    }

    /**
     * @Route("/addProduct", name="add_product")
     */
    public function addProductAction(GlobalUser $globalUser, Request $request): Response
    {
        //Seuls les admins peuvent avoir accès à cette action:
        $globalUser->checkUser($this->user, "admin");

        //Si c'est bien un admin, on fait l'action:
        $product = new Produits();

        $form = $this->createForm(AddProductType::class, $product);
        $form->add('send', SubmitType::class, ['label' => 'add a new product']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($product);
            $this->em->flush();
            $this->addFlash('info', "New product added");
            return $this->redirectToRoute('main_index');
        }

        if ($form->isSubmitted())
            $this->addFlash('info', 'Form not correct');

        $args = array('myform' => $form->createView());
        return $this->render('Utilisateurs/Admin/add_product.html.twig', $args);
    }


    /* =============================================================
     *                          LECTURE
     * ============================================================= */

    /**
     * @Route(
     *     "/liste",
     *     name="produits_liste"
     * )
     */
    public function produitsListerAction(GlobalUser $globalUser): Response
    {
        //Seuls les clients peuvent avoir accès à cette action:
        $globalUser->checkUser($this->user, "client");

        //Si c'est bien un client on fait l'action:
        $produitsRepository = $this->em->getRepository('App\Entity\Produits');
        $produits = $produitsRepository->findAll();

        return $this->render('Produits/product_list.html.twig', ['produits' => $produits]);
    }
}