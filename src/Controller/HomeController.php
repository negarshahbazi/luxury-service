<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\JobOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager, JobOfferRepository $jobOfferRepository, CategoryRepository $categoryRepository): Response
    {
        $offers = $jobOfferRepository->findTenByCreatedAt();
        $category = $categoryRepository->findAll();
        return $this->render('home/index.html.twig', [
            'offers' => $offers,
            'category' => $category
        ]);
    }
    #[Route('/company', name: 'app_company')]
    public function company(): Response
    {
        return $this->render('home/company.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
