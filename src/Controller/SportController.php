<?php

namespace App\Controller;

use App\Form\SportType;
use App\Entity\Sport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class SportController extends AbstractController
{
    #[Route('/sport', name: 'app_sport')]
    public function index(): Response
    {
        return $this->render('sport/index.html.twig', [
            'controller_name' => 'SportController',
        ]);
    }

    #[Route('/sport/new', name: 'app_sport_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sprt = new Sport();
        $form = $this->createForm(SportType::class, $sprt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sprt);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('sport/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
