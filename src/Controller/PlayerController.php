<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerType;
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
    public function index(): Response
    {
        return $this->render('player/index.html.twig', [
            'controller_name' => 'PlayerController',
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
     public function new(Request $request, EntityManagerInterface $entityManager): Response
     {
         $ply = new Player();
         $form = $this->createForm(PlayerType::class, $ply);
         $form->handleRequest($request);
 
         if ($form->isSubmitted() && $form->isValid()) {
             $entityManager->persist($ply);
             $entityManager->flush();
 
             return $this->redirectToRoute('app_home');
         }
 
         return $this->render('player/playerinscri.html.twig', [
             'form' => $form->createView(),
         ]);
     }
 
}
