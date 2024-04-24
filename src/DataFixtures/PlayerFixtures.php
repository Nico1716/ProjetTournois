<?php

namespace App\DataFixtures;

use App\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory; 

class PlayerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //$faker = Factory::create('fr_FR');
        for ($i=0; $i<100; $i++) {
            $personne = new Player();
            //$personne->($faker->firstName);
            //$personne->setLastName($faker->lastName);
           // $personne->setAge($faker->numberBetween(18,65));

            $manager->persist($personne);
        }
        $manager->flush();
    }
}
