<?php

namespace App\DataFixtures;

use App\Entity\Location;
use App\Entity\Offer;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const NB_OFFERS = 50;
    private const NB_LOCATIONS = 5;


    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $locations = [];

        for ($i = 0; $i < self::NB_LOCATIONS; $i++){
            $location = new Location;
            $location->setName($faker->city());

            $manager->persist($location);
            $locations[] = $location;
        }

        for ($i = 0; $i < self::NB_OFFERS; $i++){
            $offer = new Offer;
            $offer
                ->setTitle($faker->jobTitle())
                ->setDescription($faker->realText($maxNbChars = 200, $indexSize = 2))
                ->setPostDate($faker->dateTime())
                ->setVisible($faker->boolean())
                ->setLocation($locations[random_int(0, count($locations)-1)]);
                
            $manager->persist($offer);
        }
        $manager->flush();
    }
}