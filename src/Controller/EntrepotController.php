<?php

namespace App\Controller;

use App\Entity\Entrepot;
use App\Form\EntrepotFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EntrepotController extends AbstractController
{
    #[Route('/entrepot', name: 'app_entrepot')]
    public function index(): Response
    {
        return $this->render('entrepot/index.html.twig', [
            'controller_name' => 'EntrepotController',
        ]);
    }

    #[Route('/ajouterentrepot', name: 'app_ajouter_entrepot')]
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
                $this->addFlash('success', "L'entrepot a été ajouté avec succès.");
    
                // Redirection
                return $this->redirectToRoute('app_ajouter_entrepot');
            } else {
                // Message flash si le formulaire est soumis mais invalide
                $this->addFlash('error', 'Le formulaire contient des erreurs. Veuillez les corriger.');
            }
        }
    

        // Affichage du formulaire dans la vue Twig
        return $this->render('entrepot/ajouterentrepot.html.twig', [
            'entrepotForm' => $form->createView(),
        ]);
    }
}
