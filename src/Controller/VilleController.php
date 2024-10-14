<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Form\VilleFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VilleController extends AbstractController
{
    #[Route('/ville', name: 'app_ville')]
    public function index(): Response
    {
        return $this->render('ville/index.html.twig', [
            'controller_name' => 'VilleController',
        ]);
    }

    #[Route('/ajouterville', name: 'app_ajouter_ville')]
    public function definirDistance(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création d'une nouvelle instance de l'entité Produit
        $ville = new Ville();
    
        // Création du formulaire en associant l'entité Produit
        $form = $this->createForm(VilleFormType::class, $ville);

        // Traitement de la requête HTTP
        $form->handleRequest($request);

        // Vérification si le formulaire a été soumis et si les données sont valides
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                // Sauvegarde du produit
                $ville = $form->getData();
                $entityManager->persist($ville);
                $entityManager->flush();
    
                // Message de succès
                $this->addFlash('success', 'La ville a été ajouté avec succès.');
    
                // Redirection
                return $this->redirectToRoute('app_ajouter_ville');
            } else {
                // Message flash si le formulaire est soumis mais invalide
                $this->addFlash('error', 'Le formulaire contient des erreurs. Veuillez les corriger.');
            }
        }
    

        // Affichage du formulaire dans la vue Twig
        return $this->render('ville/ajouterville.html.twig', [
            'villeForm' => $form->createView(),
        ]);
    }
}
