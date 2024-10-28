<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

//on définit la route et l'action dans le même fichier Controller
class MainController extends AbstractController
{
    #[Route('/log-in', name:"home")]
    //définit une route sous forme d'attribut

     function index(): Response
    {
        
        return $this->render('logIn.html.twig');
    }
}