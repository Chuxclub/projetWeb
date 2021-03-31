<?php


namespace App\Controller\Utilisateurs;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/clients")
 */
class ClientsController extends AbstractController
{
    /**
     * @Route("/create_customer_account", name="create_customer_account")
     */
    public function createCustomerAccountAction(): Response
    {
        return $this->render('create_customer_account.html.twig');
    }
}