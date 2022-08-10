<?php

namespace App\Controller;

use App\Entity\Annonce;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    private  $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    #[Route('/account', name: 'account')]

    public function index(): Response
    {
        $idUser = $this->getUser();
        // rechercher les articles avec la propriété user = 1
        $annonceUser = $this->entityManager->getRepository(Annonce::class)->findUser($idUser);
        // dd($produitUser);
        return $this->render('account/index.html.twig', [
            'annonceUser' => $annonceUser

        ]);
    }
    #[Route('/annonce-vue/{slug}', name: 'annonce_vue')]
    public function view($slug): Response
    {
        $annonce = $this->entityManager->getRepository(Annonce::class)->findOneBySlug($slug);

        if (!$annonce) {
            return $this->redirectToRoute('account');
        }
        return $this->render('account/viewAnnonce.html.twig', [
            'annonce' => $annonce
        ]);
    }
    
}
