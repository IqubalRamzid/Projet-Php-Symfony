<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    /**
     * @Route("/particuliers", name="particuliers")
     */
    public function particuliers()
    {
        return $this->render('particuliers.html.twig');
    }
    /**
     * @Route("/professionel",name="professionel")
     */
    public function professionel()
    {
        return $this->render('professionel.html.twig');
    }
}
