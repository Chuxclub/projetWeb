<?php


namespace App\Controller\Utilisateurs;


use App\Entity\Utilisateurs;
use App\Service\GlobalUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\CreateAccountType;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/visiteurs")
 */
class VisiteursController extends AbstractController
{
    private $em;
    private $user;

    public function __construct(GlobalUser $globalUser, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->user = $globalUser->getGlobalUser();
    }

    /**
     * @Route("/createAccount", name="create_account")
     */
    public function createAccountAction(Request $request): Response
    {
        $newUser = new Utilisateurs();

        $form = $this->createForm(CreateAccountType::class, $newUser);
        $form->add('send', SubmitType::class, ['label' => 'create account']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
                $this->em->persist($newUser);
                $this->em->flush();
                $this->addFlash('info', "New account created");
                return $this->redirectToRoute('main_index');
        }

        if ($form->isSubmitted())
            $this->addFlash('info', 'Form not correct');

        $args = array('myform' => $form->createView());
        return $this->render('Utilisateurs/Visiteur/create_customer_account.html.twig', $args);
    }

    /**
     * @Route(
     *     "/connexion",
     *     name="utilisateurs_connexion"
     * )
     */
    public function connectAction(): Response
    {
        $this->addFlash('info', "You will soon be able to connect !");
        return $this->redirectToRoute("main_index");
    }
}