<?php

namespace App\Controller;

use App\Repository\EntrepotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VoirCasierController extends AbstractController
{
    #[Route('/voir/casier', name: 'app_voir_casier')]
    public function index(): Response
    {
        return $this->render('voir_casier/index.html.twig', [
            'controller_name' => 'VoirCasierController',
        ]);
    }

    #[Route('/entrepot/{id}', name: 'entrepot_show')]
    public function show(EntrepotRepository $entrepotRepository, int $id): Response
    {
        $entrepot = $entrepotRepository->find($id);

        if (!$entrepot) {
            throw $this->createNotFoundException('Entrepôt non trouvé');
        }

        return $this->render('voircasier/show.html.twig', [
            'entrepot' => $entrepot,
            'casiers' => $entrepot->getLesCasiers(),
        ]);
    }
}
