<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;

use Doctrine\ORM\EntityManagerInterface;

class MessageAdminController extends AbstractController
{
    #[Route('/messages/add', name: 'message.addNew', methods: ['POST'])]
    public function addMessage(Request $request, EntityManagerInterface $entityManager): Response {
        // Create the form for the Message entity
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);

        // Handle the request with the form
        $form->handleRequest($request);

        // Check if form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            // Persist the new message to the database
            $entityManager->persist($message);
            $entityManager->flush();

            // Redirect to a success page or list of messages
            return $this->render('messageSuccess.html.twig'); 
        }

        return $this->render('new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/messages/{id}/delete', name: 'message.delete', methods: ['DELETE'])]
    public function deleteMessage(Request $request, int $messageId, MessageRepository $messageRepository, EntityManagerInterface $entityManager): Response {

        $message = $messageRepository->delete($messageId);

        return $this->render('messageSuccess.html.twig');

    }
}