<?php


namespace App\Controller\Utilisateurs;


use App\Entity\Utilisateurs;
use App\Form\CreateAccountType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/admin")
 */
class AdminController extends AbstractController
{

    /**
     * @Route("/manageAccount", name="manage_account")
     */
    public function manageAccountAction(): Response
    {
        $users = $this->getDoctrine()->getRepository(Utilisateurs::class)->findAll();

        return $this->render('Utilisateurs/Admin/manage_users.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/deleteAccount/{id}", name="delete_account")
     */
    public function deleteAccountAction(Utilisateurs $user): Response
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute("main_index");
    }

}