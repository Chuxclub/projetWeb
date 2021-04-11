<?php

namespace App\Service;

use App\Entity\Utilisateurs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GlobalUserService extends AbstractController
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

    public function checkUser(?Utilisateurs $user, $userType)
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