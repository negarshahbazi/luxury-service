<?php

namespace App\Controller;

use App\Entity\Candidats;
use App\Entity\Candidatures;
use App\Entity\JobOffer;
use App\Repository\CandidatsRepository;
use App\Repository\CandidaturesRepository;
use App\Repository\CategoryRepository;
use App\Repository\JobOfferRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OfferController extends AbstractController
{  // pour afficher des jobs
    #[Route('/offer', name: 'app_offer')]
    public function index(JobOfferRepository $jobOfferRepository,  CategoryRepository $categoryRepository): Response
    {
        $offers = $jobOfferRepository->findAll();
        $category = $categoryRepository->findAll();
        return $this->render('offer/index.html.twig', [
            'offers' => $offers,
            'category'=>$category
        ]);
    }
    // pour afficher detaile de chaque job
    #[Route('/offer/{id}', name: 'app_offer_show')]
    public function show(JobOffer $offer, JobOfferRepository $jobOfferRepository): Response
    {
        $offers = $jobOfferRepository->findAll();
        $previousOffer = $jobOfferRepository->findPreviousOffer($offer);
        $nextOffer = $jobOfferRepository->findNextOffer($offer);
        $user = $this->getUser();
        if ($user) {

            return $this->render('offer/show.html.twig', [
                'offer' => $offer,
                'offers' => $offers,
                'previousOffer' => $previousOffer,
                'nextOffer' => $nextOffer
            ]);
        } else {
            return $this->redirectToRoute('app_login');
        }
    }
    // pour apply de chaque job

    #[Route('/offer/{id}/apply', name: 'app_offer_apply')]
    public function apply(JobOffer $offer, CandidaturesRepository $candidaturesRepository, CandidatsRepository $candidatsRepository, EntityManagerInterface $entityManager): Response
    {


        $user = $this->getUser();
        // $candidat = $this->getCandidats();
        if (!$user) {
            $this->addFlash('failed', 'You must be logged to submit an application');
            return $this->redirectToRoute('app_register');
        }
        $candidat = $candidatsRepository->findOneBy(['user' =>   $user]);
        //    dd( $candidat);
        // find the candidatures avec le repository;
        $candidatures = $candidaturesRepository->findOneBy(['jobOffer' => $offer , 'candidats' => $candidat ]);
        // dd( $candidatures);

        if(!$candidatures){
        $candidatures = new Candidatures();
        // Set the job offer for the candidature
        $candidatures->setJobOffer($offer);
        // Set the candidat for the candidature
        $candidatures->setCandidats($candidat);
        // Set the application date
        $candidatures->setDate(new DateTimeImmutable());
        $entityManager->persist($candidatures);
        $entityManager->flush();
         // Add a flash message to indicate successful application
        $this->addFlash('success', 'Your application has been submitted successfully.');
        } 
        else {
            $this->addFlash('success', 'You have already applied for this job.');
        }
        

        
         return $this->redirectToRoute('app_home');
    
    }




}
