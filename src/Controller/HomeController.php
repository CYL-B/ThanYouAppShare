<?php

namespace App\Controller;

use App\Entity\User;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;


//on définit la route et l'action dans le même fichier Controller
class HomeController extends AbstractController
{
    #[Route('/', name: "home")]
    //définit une route sous forme d'attribut

    function index(Request $request): Response
    {
        return $this->redirectToRoute('app_login');
    }
}
