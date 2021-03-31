<?php


namespace App\Controller\Utilisateurs;


use App\Entity\Utilisateurs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\CreateAccountType;

/**
 * @package App\Controller
 * @Route("/visiteurs")
 */
class VisiteursController extends AbstractController
{
    /**
     * @Route("/createAccount", name="create_account")
     */
    public function createAccountAction(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $newUser = new Utilisateurs();

        $form = $this->createForm(CreateAccountType::class, $newUser);
        $form->add('send', SubmitType::class, ['label' => 'create account']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
                $em->flush();
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
    public function disconnectAction(): Response
    {
        $this->addFlash('info', "You will soon be able to connect !");
        return $this->redirectToRoute("main_index");
    }
}