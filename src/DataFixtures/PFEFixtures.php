<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory ;
use App\Entity\PFE ;
use App\Entity\Entreprise ;
use App\Repository\EntrepriseRepository ;

class PFEFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR') ;
        for($i=0; $i<100 ; $i++){
            $pfe = new PFE() ;

            // $repository = $doctrine->getRepository(Entreprise::class) ;
            // $entreprise = $repository->find($faker->numberBetween(1,99)) ;
            // $pfe->setEntreprise($entreprise) ;
            // $pfe->setEntreprise($faker->numberBetween(1,99)) ;
            $pfe->setEtudiant($faker->firstName) ;
            $pfe->setTitle($faker->firstName) ;

            $manager->persist($pfe);
        }

        $manager->flush();
    }
}
