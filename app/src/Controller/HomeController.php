<?php 

namespace App\Controller;

use App\Repository\MusicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;


class HomeController extends AbstractController
{

    #[Route("/home", name: "accueil")]
    public function home(MusicRepository $musicRepo)
    {
        return $this->render("home/home.html.twig",[
            "musics" => $musicRepo->findAll(),
        ]);
    }

    #[Route('/disconnect', name: "disconnect")]
    public function disconnect()
    {
        return $this->render("home/disconnect.html.twig");
    }

    #[Route('/home/viewDetail', name: "viewDetail")]
    public function viewDetail()
    {
        return $this->render("music/viewDetail.html.twig");
    }

}