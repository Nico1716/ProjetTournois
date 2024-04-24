<?php

namespace App\Controller;

use App\Entity\Player;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('player')]
class PlayerController extends AbstractController
{
    #[Route('/', name: 'app_player')]
    public function index(): Response
    {
        return $this->render('player/index.html.twig', [
            'controller_name' => 'PlayerController',
        ]);
    }
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
}
