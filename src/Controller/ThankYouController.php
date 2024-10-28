<?php 
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\BrowserKit\Request;

class ThankYouController extends AbstractController
{

    #[Route('/thank-you', name: 'thank-you.index')]
    function index(): Response
    {
        return $this->render('thankYou/thank-you-list.html.twig');
    }


    #[Route('/thank-you/{slug}-{id}', name: 'thank-you.showNote', requirements:["id" => '\d+', "slug" => '[a-z0-9-]+'])]
    public function showNote(Request $request, string $slug, int $id): Response
    {
        return $this->render('thankYou/thank-you.html.twig', [
            'id' => $id,
            "slug" => $slug,
            "TYN" => [
                'author',
                'date',
                'message',
                'recipient',
                'url'
            ]
        ]);
    }
} 