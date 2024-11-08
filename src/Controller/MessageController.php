<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

use Psr\Log\LoggerInterface;


use App\Repository\MessageRepository;

class MessageController extends AbstractController
{

    #[Route('/messages', name: 'message.index')]
    function index(Request $request, MessageRepository $messageRepository): Response
    {
        //récupère tous les messages de la BDD
        $listMessages = $messageRepository->findAll();

        return $this->render('messages/messages.html.twig', ["listMessages" => $listMessages]);
        //envoie la variable messages contenant tous les messages récupérés de la DBB
    }


    #[Route('/messages/{slug}-{id}', name: 'message.showNote', requirements: ["id" => '\d+', "slug" => '[a-z0-9-]+'])]
    public function showNote(Request $request, string $slug, int $id, MessageRepository $messageRepository): Response
    {
        $user = $this->getUser();
        $message = $messageRepository->find($id);
        if ($message->getSlug() != $slug) {
            return $this->redirectToRoute('message.showNote', ['slug' => $message->getSlug(), 'id' => $message->getId()]);
        };

        return $this->render('messages/message.html.twig', [
            'id' => $id,
            "slug" => $slug,
            "user" => $user,
            "message" => [
                'author' => $message->getSender(),
                'date' => $message->getCreatedAt(),
                'content' => $message->getMessageText(),
                'recipient' => $message->getRecipient(),
                'title' => $message->getTitle(),
                'id' => $message->getId()
            ]
        ]);
    }
}
