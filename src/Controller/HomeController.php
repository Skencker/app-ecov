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

class HomeController extends AbstractController
{
    private  $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'home')]
    public function index(Request $request): Response
    {
        $annonces = $this ->entityManager->getRepository(Annonce::class)->findBy(array(),array('create_at' => 'DESC'));

        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        
        $form->handleRequest($request); 
        
        if ($form->isSubmitted() && $form->isValid()) {
            $annonces= $this->entityManager->getRepository(Annonce::class)->findWithSearch($search);
        }
        return $this->render('home/index.html.twig', [
            'annonces' => $annonces,
            'form' => $form->createView()
        ]);
    }
}
