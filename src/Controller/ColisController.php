<?php

namespace App\Controller;

use App\Entity\Colis;
use App\Form\ColisFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ColisController extends AbstractController
{
    #[Route('/colis', name: 'app_colis')]
    public function index(): Response
    {
        return $this->render('colis/index.html.twig', [
            'controller_name' => 'ColisController',
        ]);
    }

    #[Route('/ajoutercolis', name: 'app_ajouter_colis')]
    public function ajoutercolis(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création d'une nouvelle instance de l'entité Produit
        $colis = new Colis();
    
        // Création du formulaire en associant l'entité Produit
        $form = $this->createForm(ColisFormType::class, $colis);

        // Traitement de la requête HTTP
        $form->handleRequest($request);

        // Vérification si le formulaire a été soumis et si les données sont valides
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                // Sauvegarde du produit
                $colis = $form->getData();
                $entityManager->persist($colis);
                $entityManager->flush();
    
                // Message de succès
                $this->addFlash('success', 'Le colis a été ajouté avec succès.');
    
                // Redirection
                return $this->redirectToRoute('app_ajouter_colis');
            } else {
                // Message flash si le formulaire est soumis mais invalide
                $this->addFlash('error', 'Le formulaire contient des erreurs. Veuillez les corriger.');
            }
        }
    

        // Affichage du formulaire dans la vue Twig
        return $this->render('colis/ajoutercolis.html.twig', [
            'colisForm' => $form->createView(),
        ]);
    }
}
