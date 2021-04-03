<?php

namespace App\Service;

use App\Entity\Utilisateurs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GlobalUser extends AbstractController
{
    public function getGlobalUser(): ?Utilisateurs
    {
        $userLogin = $this->getParameter('login');

        $em = $this->getDoctrine()->getManager();
        $utilisateursRepository = $em->getRepository('App:Utilisateurs');

        /** @var Utilisateurs $user */
        $user = $utilisateursRepository->findOneBy(['login' => $userLogin]);
        return $user;
    }
}