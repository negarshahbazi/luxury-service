<?php

namespace App\Controller;

use App\Entity\Candidats;
use App\Entity\Media;
use App\Entity\User;
use App\Form\CandidatsType;
use App\Form\UserType;
use App\Repository\CandidatsRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/candidats')]
class CandidatsController extends AbstractController
{
    #[Route('/', name: 'app_candidats_index', methods: ['GET'])]
    public function index(CandidatsRepository $candidatsRepository): Response
    {
        return $this->render('candidats/index.html.twig', [
            'candidats' => $candidatsRepository->findAll(),
        ]);
    }

    // #[Route('/{id}/new', name: 'app_candidats_new', methods: ['GET', 'POST'])]
    // public function new(Request $request,FileUploader $fileUploader, EntityManagerInterface $entityManager, User $user, CandidatsRepository $candidatsRepository): Response
    // {   
    //     $candidat = $candidatsRepository->findOneBy(['user' => $user]);
    //     if($candidat) {
    //         return $this->redirectToRoute('app_candidats_edit', ["id" => $user->getId()]);
    //     }
        
    //     $media = new Media();
    //     $candidat = new Candidats();

    //     $user = $this->getUser();
 
    //     $form = $this->createForm(CandidatsType::class, $candidat);
    //     $form->handleRequest($request);
    //     // $userForm = $form->get('user');

    //     if ($form->isSubmitted() && $form->isValid()) {

    //         $photoFile = $form->get('photo')->getData();
    //         if ($photoFile) {
    //             $photoFileName = $fileUploader->upload($photoFile);
    //             $media ->setUrl($photoFileName);
    //             $candidat->setPhoto($media);
    //         }
    //         $cvFile = $form->get('cv')->getData();
    //         if ($cvFile) {
    //             $cvFileName = $fileUploader->upload($cvFile);
    //             $media ->setUrl($cvFileName);
    //             $candidat->setCv($media);
    //         }
    //         $passeportFile = $form->get('passeport')->getData();
    //         if ($passeportFile) {
    //             $passeportFileName = $fileUploader->upload($passeportFile);
    //             $media ->setUrl($passeportFileName);
    //             $candidat->setPasseport($media);
    //         }
         

    //         $candidat->setUser($user); 

            
    //         // On vérifie les champs pour modifier le percentCompleted
    //         $candidat->setPercentCompleted($candidat->checkPercentCompleted());
    //         // dd($candidat);

    //         $entityManager->persist($candidat);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_candidats_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('candidats/new.html.twig', [
    //         'candidat' => $candidat,
    //         'user'=>$user,
    //         'form' => $form,
            
    //     ]);
    // }

    #[Route('/{id}', name: 'app_candidats_show', methods: ['GET'])]
    public function show(Candidats $candidat): Response
    {
        return $this->render('candidats/show.html.twig', [
            'candidat' => $candidat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_candidats_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request,FileUploader $fileUploader, EntityManagerInterface $entityManager, User $user, CandidatsRepository $candidatsRepository): Response
    {
        $candidat = $candidatsRepository->findOneBy(['user' => $user]);
        if(!$candidat) {
            $candidat = new Candidats();
            $candidat->setUser($user);
            $entityManager->persist($candidat);
        }
        
       
                
        $media = new Media();

        $form = $this->createForm(CandidatsType::class, $candidat);
        $form->handleRequest($request);

        $userForm = $this->createForm(UserType::class, $user);
        $userForm->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $photoFile = $form->get('photo')->getData();
            if ($photoFile) {
                $photoFileName = $fileUploader->upload($photoFile);
                $media ->setUrl($photoFileName);
                $candidat->setPhoto($media);
            }
            $cvFile = $form->get('cv')->getData();
            if ($cvFile) {
                $cvFileName = $fileUploader->upload($cvFile);
                $media ->setUrl($cvFileName);
                $candidat->setCv($media);
                
            }
            $passeportFile = $form->get('passeport')->getData();
            if ($passeportFile) {
                $passeportFileName = $fileUploader->upload($passeportFile);
                $media ->setUrl($passeportFileName);
                $candidat->setPasseport($media);
            }
            
            
            // On vérifie les champs pour modifier le percentCompleted
            $candidat->setPercentCompleted($candidat->checkPercentCompleted());
            // dd($candidat);
            
            $entityManager->flush();
        

            return $this->redirectToRoute('app_candidats_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('candidats/edit.html.twig', [
            'candidat' => $candidat,
            'user'=>$user,
            'form' => $form,
            'userForm' => $userForm
        ]);
    }

    #[Route('/{id}', name: 'app_candidats_delete', methods: ['POST'])]
    public function delete(Request $request, Candidats $candidat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidat->getId(), $request->request->get('_token'))) {
            $entityManager->remove($candidat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_candidats_index', [], Response::HTTP_SEE_OTHER);
    }




    
}
