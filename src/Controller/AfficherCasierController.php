<?php

namespace App\Controller;

use App\Entity\Casier;
use App\Repository\CasierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AfficherCasierController extends AbstractController
{
    #[Route('/afficher/casier', name: 'app_afficher_casier')]
    public function index(): Response
    {
        return $this->render('afficher_casier/index.html.twig', [
            'controller_name' => 'AfficherCasierController',
        ]);
    }

    #[Route('/afficher/casier/{id}', name: 'app_afficher_un_casier')]
    public function voirToutesLesStations (Casier $leCasier) : Response
    {    
        return $this->render('afficher_casier/voiruncasier.html.twig', [
            'monCasier' => $leCasier,
        ]);
    }
}
