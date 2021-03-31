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
}
