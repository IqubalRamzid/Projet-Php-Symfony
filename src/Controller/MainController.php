<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/index", name="app_home")
     */
    public function index()
    {
        return $this->render('main/index.html.twig');
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
    /**
     * @Route("/contact",name="contact")
     */
    public function contact()
    {
        return $this->render('contact.html.twig');
    }
    /**
     * @Route("/robots.txt",name="robots.txt")
     */
}
