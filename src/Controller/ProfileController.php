<?php

namespace App\Controller;


use App\Entity\Profile;
use App\Repository\ProfileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'profiles')]
    public function index(ProfileRepository $profileRepository): Response
    {
        $profiles = $profileRepository->findAll();

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'profiles' => $profiles,
        ]);
    }


    #[Route('/profile/{id}', name: 'profile')]
    public function profile(Profile $profile, ProfileRepository $profileRepository): Response
    {
        return $this->render('profile/show.html.twig', [
            'controller_name' => 'ProfileController',
            'profile' => $profile,
        ]);
    }


}
