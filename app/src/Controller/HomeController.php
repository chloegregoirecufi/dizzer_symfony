<?php 

namespace App\Controller;

use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;


class HomeController extends AbstractController
{

    private $albumRepo;

    public function __construct(AlbumRepository $albumRepository)
    {
        $this->albumRepo = $albumRepository;
    }

    #[Route("/home", name: "accueil")]
    public function home(AlbumRepository $albumRepo)
    {
        return $this->render("home/home.html.twig",[
            "albums" => $this->albumRepo->findAll(),
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