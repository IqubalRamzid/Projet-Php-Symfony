<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UsersRepository;



class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("Admin/users", name="Admin_list_user")
     */
    public function adminListUser(UsersRepository $userRepository)
    {
        $users = $userRepository->findAll();

        return $this->render("admin/user_list.html.twig", ['users' => $users]);
    }

    /**
     * @Route("Admin/user/{id}", name="Admin_show_user")
     */
    public function adminShowUser($id, UsersRepository $userRepository)
    {
        $users = $userRepository->find($id);

        return $this->render("admin/user_show.html.twig", ['users' => $users]);
    }

    /**
     * @Route("Admin/create/user", name="Admin_create_user")
     */
    public function adminCreateUser(
        Request $request,
        EntityManagerInterface $entityManagerInterface,
        UserPasswordHasherInterface $userPasswordHasherInterface
    ) {
        $users = new Users();

        $userForm = $this->createForm(UserFormType::class, $users);

        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {;


            $plainPassword = $userForm->get('password')->getData();

            $hashedPassword = $userPasswordHasherInterface->hashPassword($users, $plainPassword);

            $users->setPassword($hashedPassword);

            $entityManagerInterface->persist($users);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("Admin_list_user");
        }

        return $this->render('admin/user_form.html.twig', ['userForm' => $userForm->createView()]);
    }

    /**
     * @Route("Admin/update/user/{id}", name="Admin_update_user")
     */
    public function adminUpdateUser(
        $id,
        UsersRepository $userRepository,
        EntityManagerInterface $entityManagerInterface,
        Request $request,
        UserPasswordHasherInterface $userPasswordHasherInterface
    ) {
        $users = $userRepository->find($id);

        $userForm = $this->createForm(UserFormType::class, $users);

        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {;


            $plainPassword = $userForm->get('password')->getData();

            $hashedPassword = $userPasswordHasherInterface->hashPassword($users, $plainPassword);

            $users->setPassword($hashedPassword);

            $entityManagerInterface->persist($users);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("Admin_list_user");
        }

        return $this->render('admin/user_form.html.twig', ['userForm' => $userForm->createView()]);
    }

    /**
     * @Route("Admin/delete/{id}", name="Admin_delete")
     */
    public function adminDeleteUser(
        $id,
        EntityManagerInterface $entityManagerInterface,
        UsersRepository $userRepository
    ) {
        $users = $userRepository->find($id);

        $entityManagerInterface->remove($users);
        $entityManagerInterface->flush();

        return $this->redirectToRoute("Admin_list_user");
    }
}
