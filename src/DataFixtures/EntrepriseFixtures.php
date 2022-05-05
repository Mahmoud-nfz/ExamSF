<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory ;
use App\Entity\Entreprise ;

class EntrepriseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR') ;
        for($i=0; $i<100 ; $i++){
            $e = new Entreprise() ;
            $e->setDesignation($faker->firstName) ;

            $manager->persist($e);
        }

        $manager->flush();
    }
}
