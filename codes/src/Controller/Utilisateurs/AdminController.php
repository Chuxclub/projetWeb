<?php


namespace App\Controller\Utilisateurs;


use App\Entity\Utilisateurs;
use App\Service\GlobalUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        $this->em->remove($user);
        $this->em->flush();

        return $this->redirectToRoute("main_index");
    }
}