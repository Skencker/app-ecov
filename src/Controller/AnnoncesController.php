<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Form\AnnonceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AnnoncesController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/compte/ajout/annonce', name: 'add_annonce')]
    #[Route('/compte/edit/annonce{id}', name: 'edit_annonce')]

    public function index(Annonce $annonce = null, Request $request): Response
    {
        if(!$annonce) {
            $annonce = new Annonce;
        }
        $form = $this->createForm(AnnonceType::class, $annonce);

        $form->handleRequest(($request));

        if($form->isSubmitted() && $form->isValid()) {
            $annonce = $form->getData();

            $image = $form->get('image')->getData();
            $ext = $image->guessExtension();
            $imageName = md5(uniqid()).'.' . $ext;
            $image->move(
                $this->getParameter('images_directory'),
                $imageName
            );
            $annonce->setImage($imageName);

            $name = $form->get("name")->getData();

            $annonce->setSlug($name);
            
            if(!$annonce->getId()) {
                $annonce ->setCreateAt(new \dateTime());
            }
            $annonce ->setUser($this->getUser());
            
            $this->entityManager->persist($annonce);
            $this->entityManager->flush();
            
            return $this->redirectToRoute(('account'));
        }


        return $this->render('account/addAnnonce.html.twig', [
            'form' => $form->createView(),
            'editMode' => $annonce->getId() !== null
        ]);
    }
    #[Route('/compte/annonce/supprimer/{id}', name: 'delete_annonce')]

    public function delete(Annonce $annonce) {
        // dd($product->getId());
        $this->entityManager->remove($annonce);
        $this->entityManager->flush();
        return $this->redirectToRoute('account');
        
    }
}
