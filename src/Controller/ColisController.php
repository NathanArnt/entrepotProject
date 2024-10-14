<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
