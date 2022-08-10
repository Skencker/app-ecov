<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Annonce;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogueController extends AbstractController
{
    private  $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    #[Route('/catalogue', name: 'catalogue')]
    public function index(Request $request): Response
    {
        $annonces = $this ->entityManager->getRepository(Annonce::class)->findBy(array(),array('create_at' => 'DESC'));

        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        
        $form->handleRequest($request); 
        
        if ($form->isSubmitted() && $form->isValid()) {
            $annonces= $this->entityManager->getRepository(Annonce::class)->findWithSearch($search);
        }
        return $this->render('catalogue/index.html.twig', [
            'annonces' => $annonces,
            'form' => $form->createView()
        ]);
    }

    #[Route('/catalogue/{slug}', name: 'annonce')]
    public function show($slug): Response
    {
        $produit = $this->entityManager->getRepository(Annonce::class)->findOneBySlug($slug);

        if (!$produit) {
            return $this->redirectToRoute('catalogue');
        }
        return $this->render('catalogue/produit.html.twig', [
            'annonce' => $produit
        ]);
    }
    #[Route('/annonce-vue/{slug}', name: 'annonce_vue')]
    public function view($slug): Response
    {
        $produit = $this->entityManager->getRepository(Annonce::class)->findOneBySlug($slug);

        if (!$produit) {
            return $this->redirectToRoute('account');
        }
        return $this->render('account/viewAnnonce.html.twig', [
            'annonce' => $produit
        ]);
    }
}
