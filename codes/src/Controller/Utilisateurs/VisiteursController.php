<?php


namespace App\Controller\Utilisateurs;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/visiteurs")
 */
class VisiteursController extends AbstractController
{
    /**
     * @Route("/create", name="create")
     */
    public function createAccountAction(): Response
    {
        return $this->render('create_customer_account.html.twig');
    }
}