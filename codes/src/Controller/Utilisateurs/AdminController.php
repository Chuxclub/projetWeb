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
     * @Route("/deleteAccount", name="delete_account")
     */
    public function deleteAccountAction(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        return $this->render('Utilisateurs/Admin/manage_users.html.twig');
    }

}