<?php

namespace App\Controller;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/skill')]
class SkillController extends AbstractController
{
    #[Route('/new', name: 'app_skill_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $skill = new Skill();
        $form = $this->createForm(SkillType::class, $skill);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($skill);
            $em->flush();

            return $this->redirectToRoute('app_profiles');
        }

        return $this->render('skill/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_skill_edit')]
    public function edit(Skill $skill, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app_profiles');
        }

        return $this->render('skill/edit.html.twig', [
            'form' => $form->createView(),
            'skill' => $skill,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_skill_delete', methods: ['POST', 'GET'])]
    public function delete(Skill $skill, EntityManagerInterface $em, Request $request): Response
    {
        // ✅ Seguridad extra: validar token CSRF si usas formulario
        if ($request->isMethod('POST')) {
            if ($this->isCsrfTokenValid('delete'.$skill->getId(), $request->request->get('_token'))) {
                $em->remove($skill);
                $em->flush();
            }
        } else {
            // ⚠️ Si lo llamas por GET (menos seguro)
            $em->remove($skill);
            $em->flush();
        }

        return $this->redirectToRoute('app_profiles');
    }

}
