<?php


namespace App\Controller\Utilisateurs;


use App\Entity\Utilisateurs;
use App\Form\CreateAccountType;
use App\Service\GlobalUser;
use Doctrine\ORM\EntityManagerInterface;
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
    private $em;
    private $user;

    public function __construct(GlobalUser $globalUser, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->user = $globalUser->getGlobalUser();
    }

    /**
     * @Route("/deleteAccount", name="delete_account")
     */
    public function deleteAccountAction(): Response
    {
        return $this->render('Utilisateurs/Admin/manage_users.html.twig');
    }

}