<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WildController extends AbstractController
{

    /**
     * @Route("/wild", name="wild_index")
     */
    public function index():Response
    {
        return $this->render('wild/index.html.twig',['website'=>'Wild Série']);
    }

    /**
     * @param $slug
     * @return Response
     * @Route("/wild/show/{slug}", defaults={"slug"="Aucune série sélectionnée, veuillez choisir une série"}, requirements={"slug":"[a-z0-9\-]*"},name="wild_show")
     */
    public function show(string $slug): Response
    {
        if ($slug)
        {
            $slug = ucwords(str_replace('-', ' ',$slug));
            return $this->render('wild/show.html.twig', ['slug' => $slug]);
        }
        elseif ($slug){
            return $this->render('wild/show.html.twig', ['slug' => "Aucune série sélectionnée, veuillez choisir une série"]);
        }
        else{
            return $this->redirectToRoute('wild_show',['slug'=>''],404);
        }

    }

}
