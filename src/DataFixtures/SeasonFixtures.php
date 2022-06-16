<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
        /*public const SEASON = [
        ['number' => '1',
        'year' => '2011',
        'description' => 'C\'EST LA SAISON 1 LOLXPTRD',
        'program' => 'Game_of_Thrones'],
        ['number' => '2',
        'year' => '2012',
        'description' => 'CA C\'EST LA SAISON 2 ENFAITE',
        'program' => 'Game_of_Thrones'],
        ['number' => '3',
        'year' => '2013',
        'description' => 'SPOILER.... SAISON 3',
        'program' => 'Game_of_Thrones'],
        ['number' => '1',
        'year' => '2010',
        'description' => 'Vous avez vue, c\'est le même acteur que le père dans la série Malcolm',
        'program' => 'Breaking_Bad'],
        ['number' => '2',
        'year' => '2010',
        'description' => 'De la drogue et des enuis',
        'program' => 'Breaking_Bad'],
        ['number' => '3',
        'year' => '2010',
        'description' => 'Ceci est un résumé',
        'program' => 'Breaking_Bad']
        ];*/

        public const REF = [
            ['Breaking_Bad'],
            ['Game_of_Thrones'],
            ['Notre_Planète'],
            ['The_Lord_Of_The_Ring'],
            ['Star_Wars'],
            ['The_Ring'],
            ['Fast_And_Furious'],
            ['Nom_De_Film_Romantic_Random'],
            ['The_Witcher'],
            ['Dragon'],
            ['Derrick'],
            ['It_Follow'],
        ];
    
        /*public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

            for($i = 0; $i < 11; $i++) {
                foreach (self::SEASONS as $key => $number){
                    $season = new Season();
                    $season->setNumber($faker->numberBetween($number));
                    $season->setYear($faker->year());
                    $season->setDescription($faker->paragraphs(3, true));
                    $season->setProgram($this->getReference('program_'.$faker->numberBetween(0, 11)));
                    $this->addReference('season_' . $faker->unique()->numberBetween(1, ), $season);
                    
                    $manager->persist($season);
                }
            }

            $manager->flush();
    }*/

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

            foreach (self::REF as $key => $ref){
                for($i = 1; $i <= 5; $i++){
                    $season = new Season();
                    $season->setNumber($i);
                    $season->setYear($faker->year());
                    $season->setDescription($faker->paragraph(3, true));
                    $season->setProgram($this->getReference('program_'. $key));
                    $this->addReference('season_'. $ref[0] . $i, $season);
                    $manager->persist($season);
                }
            }

            $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}