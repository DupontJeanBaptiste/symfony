<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAM = [
        'The lord of the ring' => ['summary' => 'L\'anneau, bla bla bla.', 'category' => 'Fantasy'], 
        'Star Wars' => ['summary' => 'Luc je suis ton père et tout et tout', 'category' => 'SF'],
        'The ring' => ['summary' => 'Je ne pourrai pas vous dire, j\'ai pas regardé', 'category' => 'Horreur'],
        'Fast and furious' => ['summary' => 'Des voitures et des muscles', 'category' => 'Action'],
        'Nom de film romantic random' => ['summary' => 'aled.', 'category' => 'Romance'],
        'The witcher' => ['summary' => 'Comme le jeu, mais en film', 'category' => 'Fantasy'],
        'Dragon' => ['summary' => 'Le meileur film d\'animation enfaite', 'category' => 'Fantasy'],
        'Derik' => ['summary' => 'Je sais, je suis taquin', 'category' => 'Action'],
        'It follow' => ['summary' => 'Celui là je l\'ai vue.. j\'ai pas dormi pendant deux semaines', 'category' => 'Horreur'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAM as $programName => $infos) {
            $program = new Program();
            $program->setTitle($programName);
            $program->setSummary($infos['summary']);
            $program->setCategory($this->getReference('category_'.$infos['category']));
            $manager->persist($program);
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
