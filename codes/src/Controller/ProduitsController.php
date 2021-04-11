<?php


namespace App\Controller;


use App\Entity\Panier;
use App\Entity\Produits;
use App\Entity\Utilisateurs;
use App\Form\AddProductType;
use App\Service\GlobalUserService;
use App\Service\ProduitsService;
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

    public function __construct(GlobalUserService $globalUser, EntityManagerInterface $entityManager)
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
    public function addProductAction(GlobalUserService $globalUser, Request $request): Response
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
    public function produitsListerAction(GlobalUserService $globalUser, ProduitsService $produitsService): Response
    {
        //Seuls les clients peuvent avoir accès à cette action:
        $globalUser->checkUser($this->user, "client");

        //Si c'est bien un client on fait l'action:
        return $this->render('Produits/product_list.html.twig',
                                 ['produits' => $produitsService->getAllProducts($this->em)]);
    }


    /**
     * @Route(
     *     "/mail",
     *     name="produits_mail"
     * )
     */
    public function produitsMailAction(\Swift_Mailer $mailer, ProduitsService $produitsService)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('florian-1992@hotmail.fr')
            ->setTo('amandine.fradet@live.fr')
            ->setBody(
                $this->renderView(
                    'Produits/product_mail.html.twig',
                    ['nbProduits' => $produitsService->getNbProducts($this->em)]
                ),
                'text/html'
            );

        $mailer->send($message);

        return $this->render("Layouts/index.html.twig");
    }
}