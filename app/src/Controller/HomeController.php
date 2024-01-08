<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route("/home", name: "acceuil")]
    public function home()
    {
        // $lien = "<a href='page/2'>liens vers page 2</a>";
        // $lien2 = "<a href='page/3'>liens vers page 3</a>";
        // $page = $this->html("Bonjour le monde</br>".$lien." ". $lien2 , "page d'acceuil");
        // return new Response($page);

        return $this->render("home/home.html.twig", []);
    }

    #[Route("/page/{numPage}", name: "page")]
    public function page(string $numPage)
    {
        return new Response($this->html("bienvenu sur la page", "page", $numPage));
    }

    public function aboutBook()
    {
        return new Response("C'est à propos des livres");
    }

    /**
     * function de construction de la page
     * @param $titre
     * @return String
     */

    private function html($message, $titre, $number = ""): String
    {
        $html = "<html><head><title>$titre</title></head><body><p>$message</p></body></html>";

        return $html;
    }
}