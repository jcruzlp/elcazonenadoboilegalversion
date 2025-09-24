<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Form\ProfileType;
use App\Repository\ProfileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profiles')]
    public function index(ProfileRepository $profileRepository): Response
    {
        $profiles = $profileRepository->findAll();

        return $this->render('profile/index.html.twig', [
            'profiles' => $profiles,
        ]);
    }

    
    #[Route('/profile/new', name: 'app_profile_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $profile = new Profile();
        $form = $this->createForm(ProfileType::class, $profile);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($profile);
            $em->flush();
            
            return $this->redirectToRoute('app_profiles');
        }
        
        return $this->render('profile/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('/profile/{id}', name: 'profile_show')]
    public function show(Profile $profile): Response
    {
        return $this->render('profile/show.html.twig', [
            'profile' => $profile,
        ]);
    }
    
    #[Route('/profile/{id}/edit', name: 'app_profile_edit')]
    public function edit(Profile $profile, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ProfileType::class, $profile);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app_profiles');
        }

        return $this->render('profile/edit.html.twig', [
            'form' => $form->createView(),
            'profile' => $profile,
        ]);
    }

    #[Route('/profile/{id}/delete', name: 'app_profile_delete', methods: ['POST', 'GET'])]
    public function delete(Profile $profile, EntityManagerInterface $em, Request $request): Response
    {
        // Opcional: comprobar token CSRF si lo quieres más seguro
        // if ($this->isCsrfTokenValid('delete'.$profile->getId(), $request->request->get('_token'))) {

        $em->remove($profile);
        $em->flush();

        // }

        return $this->redirectToRoute('app_profiles');
    }
}
