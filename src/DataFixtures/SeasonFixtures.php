<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
        public const SEASON = [
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
        ];
    
        public function load(ObjectManager $manager): void
    {
        foreach (self::SEASON as $seasonName => $infos) {
            $season = new Season();
            $season->setNumber($infos['number']);
            $season->setYear($infos['year']);
            $season->setDescription($infos['description']);
            $season->setProgram($this->getReference('program_'.$infos['program']));
            $this->addReference($infos['program'] .'_season_' . $infos['number'], $season);
            $manager->persist($season);
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