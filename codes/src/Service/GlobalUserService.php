<?php

namespace App\Service;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GlobalUserService extends AbstractController
{
    public function getGlobalUser(): ?Utilisateur
    {
        $userLogin = $this->getParameter('login');

        $em = $this->getDoctrine()->getManager();
        $utilisateursRepository = $em->getRepository('App:Utilisateur');

        /** @var Utilisateur $user */
        $user = $utilisateursRepository->findOneBy(['login' => $userLogin]);
        return $user;
    }

    public function checkUser(?Utilisateur $user, $userType)
    {
        switch($userType)
        {
            case "client":
                if(is_null($user) || $user->getIsAdmin())
                    throw new NotFoundHttpException();
                break;

            case "admin":
                if(is_null($user) || !($user->getIsAdmin()))
                    throw new NotFoundHttpException();
                break;

            case "visiteur":
                if(!(is_null($user)))
                    throw new NotFoundHttpException();
                break;

            default:
                throw new NotFoundHttpException();
        }
    }
}


/* ====================================================================================== */
/* AUTEURS: Amandine Fradet, Florian Legendre                                             */
/* ====================================================================================== */