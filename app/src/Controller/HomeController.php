<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;


class HomeController extends AbstractController
{

    #[Route("/home", name: "acceuil")]
    public function home()
    {
        return $this->render("home/home.html.twig");
    }

}