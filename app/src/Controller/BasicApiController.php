<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;

class BasicApiController extends AbstractController
{
    #[Route("/listArtiste")]
    public function listArtiste(Request $request)
    {
        $images = [];
        $query = "";

        $form = $this->createFormBuilder()
            ->add("query", TextType::class, [
                "label" =>"champs de recherche"
            ])
            ->add('ask', SubmitType::class, [
                "label" => "Envoyer"
            ])->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $query = $form->get("query")>getdate();
            $client = HttpClient::create();
            $response = $client->request(
                'GET',
                "https://api.unsplash.com/search/photos?client_id=Tpnx5jplvFxQZprA9Pll3Ubgygi2JK5vghH7C4bgCWM&query=album&page=1&query=".$query 
            );
            $status = $response->getStatusCode();//retour du code
            $contentType = $response->getHeaders()['content-type'][0];//retour du type
            $content = $response->getContent();//retour du json
            $contentArray = $response->toArray();//transform json en array, encodé
            foreach ($contentArray['results'] as $resultat){
                $images[] = $resultat['urls']['small'];
            
            }
        }

        return $this->render("home/listPhotos.html.twig", [
            "form" => $form->createView(),
            "images" => $images,
            "query" => $query

        ]);
    }
    
}