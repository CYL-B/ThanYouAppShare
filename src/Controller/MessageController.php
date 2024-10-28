<?php 
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\MessageRepository;

class MessageController extends AbstractController
{

    #[Route('/messages', name: 'message.index')]
    function index(Request $request, MessageRepository $messageRepository, int $senderId, int $recipientId): Response

    {
        /*EntityManagerInterface $emi
        Créer un message
        $message = new Message();
        $message -> setTitle("Thank you Paul")
        -> setSlug(thank-you-paul)
        -> setMessageText("You're the best partner anyone could dream of, I'm so thankful to have you by my side")
        -> setRecipient($recipidentId)
        -> setSender($senderId)
        -> setCreatedAt(new \DateTimeMutable());
        $emi -> persist($message);
        $emi->flush();

        Delete message
        $emi->remove($messages[0])
        $emi->flush();
        */


        //récupère tous les messages de la BDD
       $messages = $messageRepository -> findAll();
       
        return $this->render('messages/messages.html.twig', ["messages" => $messages]);
        //envoie la variable messages contenant tous les messages récupérés de la DBB
    }


    #[Route('/messages/{slug}-{id}', name: 'message.showNote', requirements:["id" => '\d+', "slug" => '[a-z0-9-]+'])]
    public function showNote(Request $request, string $slug, int $id, MessageRepository $messageRepository): Response
    {
        $message = $messageRepository->find($id);
        if($message->getSlug() != $slug) {
            return $this->redirectToRoute('message.showNote', ['slug'=> $message-> getSlug(), 'id' => $message -> getId()]);
        };

        return $this->render('messages/message.html.twig', [
            'id' => $id,
            "slug" => $slug,
            "message" => [
                'author' => $message->getSender(),
                'date' => $message->getCreatedAt(),
                'content' => $message->getMessageText(),
                'recipient' => $message->getRecipient(),
                'title' => $message -> getTitle()
            ]
        ]);
    }
} 