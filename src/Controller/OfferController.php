<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OfferController extends AbstractController
{
    #[Route('/offer', name: 'app_offer')]
    public function index(): Response
    {
        return $this->render('offer/index.html.twig', [
            'controller_name' => 'OfferController',
        ]);
    }
    #[Route('/offer/{id}', name: 'app_show')]
    public function show(): Response
    {
        return $this->render('offer/show.html.twig', [
            'controller_name' => 'OfferController',
        ]);
    }
}
