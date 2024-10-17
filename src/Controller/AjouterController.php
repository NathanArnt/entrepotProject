<?php

namespace App\Controller;

use App\Entity\Colis;
use App\Entity\Distance;
use App\Entity\Entrepot;
use App\Entity\Statut;
use App\Entity\Taille;
use App\Entity\Ville;
use App\Form\ColisFormType;
use App\Form\DistanceFormType;
use App\Form\EntrepotFormType;
use App\Form\StatutFormType;
use App\Form\TailleFormType;
use App\Form\VilleFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AjouterController extends AbstractController
{
    #[Route('/ajouter', name: 'app_ajouter')]
    public function index(): Response
    {
        return $this->render('ajouter/index.html.twig', [
            'controller_name' => 'AjouterController',
        ]);
    }

    #[Route('/ajouter/colis', name: 'app_ajouter_colis')]
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
        return $this->render('ajouter/ajoutercolis.html.twig', [
            'colisForm' => $form->createView(),
        ]);
    }

    #[Route('/ajouter/distance', name: 'app_ajouter_distance')]
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
                return $this->redirectToRoute('app_ajouter_distance');
            } else {
                // Message flash si le formulaire est soumis mais invalide
                $this->addFlash('error', 'Le formulaire contient des erreurs. Veuillez les corriger.');
            }
        }
    

        // Affichage du formulaire dans la vue Twig
        return $this->render('ajouter/ajouterdistance.html.twig', [
            'distanceForm' => $form->createView(),
        ]);
    }

    #[Route('/ajouter/entrepot', name: 'app_ajouter_entrepot')]
    public function ajouterEntrepot(Request $request, EntityManagerInterface $entityManager): Response
    {   
        // Création d'une nouvelle instance de l'entité Produit
        $entrepot = new Entrepot();
    
        // Création du formulaire en associant l'entité Produit
        $form = $this->createForm(EntrepotFormType::class, $entrepot);

        // Traitement de la requête HTTP
        $form->handleRequest($request);

        // Vérification si le formulaire a été soumis et si les données sont valides
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                // Sauvegarde du produit
                $entrepot = $form->getData();
                $entityManager->persist($entrepot);
                $entityManager->flush();
                
                // Message de succès
                $this->addFlash('success', "Entrepot a été ajouté avec succès.");
    
                // Redirection
                return $this->redirectToRoute('app_ajouter_entrepot');
            } else {
                // Message flash si le formulaire est soumis mais invalide
                $this->addFlash('error', 'Le formulaire contient des erreurs. Veuillez les corriger.');
            }
        }
    
        // Affichage du formulaire dans la vue Twig
        return $this->render('ajouter/ajouterentrepot.html.twig', [
            'entrepotForm' => $form->createView(),
        ]);
    }

    #[Route('/ajouter/ville', name: 'app_ajouter_ville')]
    public function ajouterVille(Request $request, EntityManagerInterface $entityManager): Response
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
        return $this->render('ajouter/ajouterville.html.twig', [
            'villeForm' => $form->createView(),
        ]);
    }

    #[Route('/ajouter/taille', name: 'app_ajouter_taille')]
    public function ajouterTaille(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création d'une nouvelle instance de l'entité Produit
        $taille = new Taille();
    
        // Création du formulaire en associant l'entité Produit
        $form = $this->createForm(TailleFormType::class, $taille);

        // Traitement de la requête HTTP
        $form->handleRequest($request);

        // Vérification si le formulaire a été soumis et si les données sont valides
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                // Sauvegarde du produit
                $taille = $form->getData();
                $entityManager->persist($taille);
                $entityManager->flush();
    
                // Message de succès
                $this->addFlash('success', 'La taille a été ajouté avec succès.');
    
                // Redirection
                return $this->redirectToRoute('app_ajouter_taille');
            } else {
                // Message flash si le formulaire est soumis mais invalide
                $this->addFlash('error', 'Le formulaire contient des erreurs. Veuillez les corriger.');
            }
        }
    

        // Affichage du formulaire dans la vue Twig
        return $this->render('ajouter/ajoutertaille.html.twig', [
            'tailleForm' => $form->createView(),
        ]);
    }

    #[Route('/ajouter/statut', name: 'app_ajouter_statut')]
    public function ajouterStatut(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création d'une nouvelle instance de l'entité Produit
        $statut = new Statut();
    
        // Création du formulaire en associant l'entité Produit
        $form = $this->createForm(StatutFormType::class, $statut);

        // Traitement de la requête HTTP
        $form->handleRequest($request);

        // Vérification si le formulaire a été soumis et si les données sont valides
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                // Sauvegarde du produit
                $statut = $form->getData();
                $entityManager->persist($statut);
                $entityManager->flush();
    
                // Message de succès
                $this->addFlash('success', 'Le statut a été ajouté avec succès.');
    
                // Redirection
                return $this->redirectToRoute('app_ajouter_statut');
            } else {
                // Message flash si le formulaire est soumis mais invalide
                $this->addFlash('error', 'Le formulaire contient des erreurs. Veuillez les corriger.');
            }
        }
    

        // Affichage du formulaire dans la vue Twig
        return $this->render('ajouter/ajouterstatut.html.twig', [
            'statutForm' => $form->createView(),
        ]);
    }
}
