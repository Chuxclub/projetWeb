<?php


namespace App\Controller\Utilisateurs;


use App\Entity\Utilisateur;
use App\Service\GlobalUserService;
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

    public function __construct(GlobalUserService $globalUser, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->user = $globalUser->getGlobalUser();
        $globalUser->checkUser($this->user, "admin");
    }

    /**
     * @Route("/manageAccount", name="manage_account")
     */
    public function manageAccountAction(): Response
    {
        $users = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();

        return $this->render('Utilisateur/Admin/manage_users.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/deleteAccount/{id}", name="delete_account")
     */
    public function deleteAccountAction(Utilisateur $user): Response
    {
        if ($user === $this->user)
        {
            $this->addFlash('info', "Sorry, you can't delete yourself");
        }
        else
            {
            $this->em->remove($user);
            $this->em->flush();

            $this->addFlash('info', "Customer deleted");
            }
        return $this->redirectToRoute("main_index");
    }
}