<?php

namespace App\Controller;

use App\Entity\Distance;
use App\Form\DistanceFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DistanceController extends AbstractController
{
    #[Route('/distance', name: 'app_distance')]
    public function index(): Response
    {
        return $this->render('distance/index.html.twig', [
            'controller_name' => 'DistanceController',
        ]);
    }

    #[Route('/ajouterdistance', name: 'app_ajouter_distance')]
    public function ajouterDistance(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création d'une nouvelle instance de l'entité Produit
        $distance = new Distance();
    
        // Création du formulaire en associant l'entité Produit
        $form = $this->createForm(DistanceFormType::class, $distance);

        // Traitement de la requête HTTP
        $form->handleRequest($request);

        // Vérification si le formulaire a été soumis et si les données sont valides
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                // Sauvegarde du produit
                $distance = $form->getData();
                $entityManager->persist($distance);
                $entityManager->flush();
    
                // Message de succès
                $this->addFlash('success', 'La distance a été ajouté avec succès.');
    
                // Redirection
                return $this->redirectToRoute('app_definir_distance');
            } else {
                // Message flash si le formulaire est soumis mais invalide
                $this->addFlash('error', 'Le formulaire contient des erreurs. Veuillez les corriger.');
            }
        }
    

        // Affichage du formulaire dans la vue Twig
        return $this->render('distance/ajouterdistance.html.twig', [
            'distanceForm' => $form->createView(),
        ]);
    }
}
