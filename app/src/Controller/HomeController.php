<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;


class HomeController extends AbstractController
{

    #[Route("/home", name: "accueil")]
    public function home()
    {
        return $this->render("home/home.html.twig");
    }

    #[Route('/disconnect', name: "disconnect")]
    public function disconnect()
    {
        return $this->render("home/disconnect.html.twig");
    }

}