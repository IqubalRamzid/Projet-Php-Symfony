<?php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UsersRepository;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public function adminListUser(UsersRepository $userRepository)
    {
        $users = $userRepository->findAll();

        return $this->render("admin/user_list.html.twig", ['users' => $users]);
    }
}
