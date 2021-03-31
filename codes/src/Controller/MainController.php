<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/main")
 */
class MainController extends AbstractController
{
    /**
     * @Route("", name="main_index")
     */
    public function indexAction(): Response
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/create_customer_account", name="create_customer_account")
     */
    public function createCustomerAccountAction(): Response
    {
        return $this->render('create_customer_account.html.twig');
    }

    /**
     * @Route("/basket", name="basket")
     */
    public function basketAction(): Response
    {
        return $this->render('basket.html.twig');
    }
}
