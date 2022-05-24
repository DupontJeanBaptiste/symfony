<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAM = [
        'The lord of the ring' => ['summary' => 'L\'anneau, bla bla bla.'], 
        'Star Wars' => ['summary' => 'Luc je suis ton père et tout et tout'],
        'The ring' => ['summary' => 'Je ne pourrai pas vous dire, j\'ai pas regardé'],
        'Fast and furious' => ['summary' => 'Des voitures et des muscles'],
        'Nom de film romantic random' => ['summary' => 'aled.'],
    ];
    public const CATEGORY = [
        'Fantasy',
        'SF',
        'Horreur',
        'Action',
        'Romance',
    ];
    public function load(ObjectManager $manager): void
    {
        $i = 0;
        foreach (self::PROGRAM as $key => $programName) {
            $program = new Program();
            $program->setTitle($key);
            foreach ($programName as $summary => $value) {
            $program->setSummary($value);
            $program->setCategory($this->getReference('category_'.self::CATEGORY[$i]));
            $i = $i + 1;
            $manager->persist($program);
            }
        }

            $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }

}
