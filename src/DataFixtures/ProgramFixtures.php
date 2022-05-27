<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    /*public const PROGRAM = [
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
    ['title' =>,
    'summary' =>,
    'poster' =>,
    'country' =>,
    'year' =>,
    'category' =>],*/
        public const PROGRAM = [
            ['title' => 'Breaking Bad',
            'summary' => 'Un professeur de chimie de lycée chez qui on a diagnostiqué un cancer du poumon inopérable se tourne vers la fabrication et la vente de méthamphétamine pour assurer l\'avenir de sa famille.',
            'poster' => 'https://www.pause-canap.com/media/wysiwyg/serie-breaking-bad.JPG',
            'country' => 'United States',
            'year' => '2008–2013',
            'category' => 'Action',
            'reference' => 'Breaking_Bad'],
            ['title' => 'Game of Thrones',
            'summary' => 'Neuf nobles familles se battent pour le contrôle des terres mythiques de Westeros, tandis qu\'un ancien ennemi revient après avoir été endormi pendant des milliers d\'années.',
            'poster' => 'https://www.premiere.fr/sites/default/files/styles/scale_crop_border_1280x720/public/2019-02/qqqfqf_0.jpg',
            'country' => 'Westeros',
            'year' => '2011-2019',
            'category' =>'Fantasy',
            'reference' => 'Game_of_Thrones'],
            ['title' => 'Notre planète',
            'summary' => 'Série documentaire sur la diversité des habitats naturels à travers le monde, des contrées lointaines et arctiques aux océans profonds et mystérieux, en passant par les vastes paysages de l\'Afrique et les jungles de l\'Amérique du Sud.',
            'poster' => 'https://blog.okapi.fr/image/60fbda2bdfa10_kcDLxXscG8IXLlCsfT8SP4sQ0Qw.png',
            'year' => '2019',
            'category' => 'Documentaire',
            'country' => 'United-States',
            'reference' => 'Notre_Planète']
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAM as $programName => $infos) {
            $program = new Program();
            $program->setTitle($infos['title']);
            $program->setSummary($infos['summary']);
            $program->setPoster($infos['poster']);
            $program->setCategory($this->getReference('category_'.$infos['category']));
            $this->addReference('program_' . $infos['reference'], $program);
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
