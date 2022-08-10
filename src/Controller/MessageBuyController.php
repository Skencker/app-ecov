<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\MessageChat;
use App\Entity\Users;
use App\Form\Message2Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;


class MessageBuyController extends AbstractController
{
    private  $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route('/message/{id}', name: 'message_buy')]
    public function index( Request $request, MailerInterface $mailer): Response
    {

        $message = new MessageChat();
        $form = $this->createForm(Message2Type::class, $message);
        
        $form->handleRequest($request);
        
        $id = $request->attributes->get('id');       
        $annonce = $this->entityManager->getRepository(Annonce::class)->find($id);
        $userId = $annonce->getUser();
        $user = $this->entityManager->getRepository(Users::class)->find($userId);
        if ($form->isSubmitted() && $form->isValid()) {
            // $message->setIdPoduct($id);
            
            $email = (new TemplatedEmail())
            ->from('ecov-spdl@outlook.com')
            ->to($user->getEmail())
            ->subject($annonce)
            ->htmlTemplate('email/email.html.twig')
            ->context ([
                'message' => $message->getMessage(),
                'annonce' => $message->setAnnonceId($annonce->getName()),
                'seller' => $message->setUserSellId($annonce->getUser()),
                'buyer' => $message->setUserBuyId($user->getId()),
            ])
            ;

            $this->entityManager->persist($message);
            $this->entityManager->flush();

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a bien été envoyé.');
            return $this->redirectToRoute('home');
        }

        return $this->render('message_buy/index.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }


}
