<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\Sport;
use App\Form\PlayerType;
use App\Repository\PlayerRepository;
use App\Repository\SportRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/player')]
class PlayerController extends AbstractController
{
    #[Route('/', name: 'app_player')]
    public function index(PlayerRepository $playerRepository): Response
    {
        $players = $playerRepository->findAll();
        return $this->render('player/vis.html.twig', [
            'players' => $players,
        ]);
    }
    #[Route('/player/allPlayer', name: 'app_find_player')]
    public function indexAlls(ManagerRegistry $doctrine): Response
   {
        $repository = $doctrine->getRepository(Player::class);
        $personnes = $repository->findAll();

        return $this->render("player/index.html.twig", [
            'personne' => $personnes
        ]);

    }
    public function addPlayer(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $personne = new Player();

        //$personne->setFirstName("NISHIMWE");
        //$personne->setLastName("Dany chaste");
        $personne->setAge(21);
        //ajout de l'operation d'insertion de la personne dans la transaction
        $entityManager->persist($personne);
        //Exécution de la transaction
        $entityManager->flush();
        return $this->render('personne/index.html.twig', [
            'controller_name' => 'PersonneController',
            'personne' => $personne
        ]);
     }

     #[Route('/new', name: 'app_player_new', methods: ['GET', 'POST'])]
     public function new(Request $request, EntityManagerInterface $entityManager, SportRepository $sportRepository): Response
     {
         $ply = new Player();
         $form = $this->createForm(PlayerType::class, $ply);
         $form->handleRequest($request);
       
 
         if ($form->isSubmitted() && $form->isValid()) {
             $entityManager->persist($ply);
             $entityManager->flush();
 
             return $this->redirectToRoute('app_home');
         }
         $sports = $entityManager->getRepository(Sport::class)->findAll();
         return $this->render('player/playerinscri.html.twig', [
             'form' => $form->createView(),
             'sports' => $sports, // Passer les sports au template
         ]);
     }
    #[Route('/player/{id}/edit', name: 'app_player_edit', methods: ['GET', 'POST'])]
    public function edit(Player $ply, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlayerType::class, $ply);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ply);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('player/edit.html.twig', [
            'player' => $ply,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/player/{id}/delete', name: 'app_player_delete', methods: ['GET', 'POST'])]
    public function delete(Player $ply, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('remove-player-'.$ply->getId(), $request->get('_token'))) {
            $entityManager->remove($ply);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_home');
    }

    


     
 
}
