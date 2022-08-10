<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Messages;
use App\Form\MessagesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessagesController extends AbstractController
{
    private  $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    #[Route('/messages', name: 'messages')]
    public function index(): Response
    {
        return $this->render('messages/index.html.twig', [
            'controller_name' => 'MessagesController',
        ]);
    }
    
    #[Route('/send/{id}', name: 'sendId')]
    public function sendAnnonce(Request $request): Response
    {
        $id = $request->attributes->get('id');
        $annonce = $this ->entityManager->getRepository(Annonce::class)->find($id);
        $message = new Messages;
        $form = $this->createForm(MessagesType::class, $message);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $message->setSender($this->getUser());
            $message->setRecipient($annonce->getUser());
            $message->setAnnonce($annonce);
            $this->entityManager->persist($message);
            $this->entityManager->flush();
            $this->addFlash("message", "Message envoyé avec succés.");
            return $this->redirectToRoute(('catalogue'));
        }

        return $this->render("messages/send.html.twig", [
            "form"=> $form->createView()
        ]);
    }

    #[Route('/send', name: 'send')]
    public function send(): Response
    {
       
        return $this->render("messages/index.html.twig", [
        ]);
    }

    #[Route('/received', name: 'received')]
    public function received(): Response
    {
        return $this->render('messages/received.html.twig');
    }
    #[Route('/sent', name: 'sent')]
    public function sent(): Response
    {
        return $this->render('messages/sent.html.twig');
    }
    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Messages $message): Response
    {
        // $this->entityManager->persist($message);
        $this->entityManager->remove($message);
        $this->entityManager->flush();

        $this->addFlash("message", "Message supprimé.");

        return $this->redirectToRoute(('messages'));
    }


}
