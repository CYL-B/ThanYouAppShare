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
    #[Route('/', name:"home")]
    //définit une route sous forme d'attribut

     function index(Request $request, EntityManagerInterface $emi, UserPasswordHasherInterface $hashpass): Response
    {
        $user = new User();
        $user -> setEmail('myriam@doe.fr')->setUsername("Myriam")->setPassword($hashpass->hashPassword($user, 'myriam1'))->setRoles([]);
        $emi->persist($user);
        $emi->flush();
        return $this->redirectToRoute('login');
    }
}