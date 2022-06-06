<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
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
            'reference' => 'Notre_Planète'],
            ['title' => 'The lord of the ring',
            'summary' => 'L\'anneau, bla bla bla.',
            'country' => 'La terre du milieu',
            'year' => '2001',
            'poster' => 'https://i.ytimg.com/vi/vvx7m22GGtA/maxresdefault.jpg',
            'category' => 'Fantasy',
            'reference' => 'The_Lord_Of_The_Ring'],
            ['title' => 'Star Wars',
            'summary' => 'Luc je suis ton père et tout et tout',
            'category' => 'SF',
            'country' => 'L\'espace',
            'year' => '1999',
            'poster' => 'https://m.media-amazon.com/images/I/51yHBMzxszL._AC_SY445_.jpg',
            'reference' => 'Star_Wars'],
            ['title' => 'The ring',
            'summary' => 'Je ne pourrai pas vous dire, j\'ai pas regardé',
            'category' => 'Horreur',
            'year' => '2002',
            'country' => 'Je sais pas et je veux pas savoir',
            'poster' => 'https://fr.web.img6.acsta.net/pictures/17/01/10/17/11/474096.jpg',
            'reference' => 'The_Ring'],
            ['title' => 'Fast and furious',
            'summary' => 'Des voitures et des muscles',
            'category' => 'Action',
            'year' => '2001',
            'poster' => 'https://m.media-amazon.com/images/I/51iceScsERL._AC_SY445_.jpg',
            'country' => 'L\Amerique mon pote !',
            'reference' => 'Fast_And_Furious'],
            ['title' => 'Nom de film romantic random',
            'summary' => 'aled.',
            'category' => 'Romance',
            'year' => '2005',
            'poster' => 'https://pharmarosa.fr/galeria_ecomm/17392/rosa-frenesie-jaune-rose-rosiers-hybrides-de-the-52-798-premium-gold-1.png',
            'country' => 'Nanar-Land',
            'reference' => 'Nom_De_Film_Romantic_Random'],
            ['title' => 'The witcher',
            'summary' => 'Comme le jeu, mais en film',
            'category' => 'Fantasy',
            'year' => '2019',
            'poster' => 'https://fr.web.img6.acsta.net/pictures/19/12/12/12/13/2421997.jpg',
            'country' => 'Le monde de la magie',
            'reference' => 'The_Witcher'],
            ['title' => 'Dragon',
            'summary' => 'Le meileur film d\'animation enfaite',
            'category' => 'Fantasy',
            'year' => '2010',
            'poster' => 'https://fr.web.img4.acsta.net/medias/nmedia/18/73/01/74/19343191.jpg',
            'country' => 'Le monde des Dragons',
            'reference' => 'Dragon'],
            ['title' => 'Derrick',
            'summary' => 'Je sais, je suis taquin',
            'category' => 'Action',
            'year' => '0001',
            'poster' => 'https://media.ouest-france.fr/v1/pictures/MjAyMjAzMmJjMTdjYjViMmI4ZTZhNWYzOGEwYmYzY2JiYjQ4ZmE?width=1260&height=708&focuspoint=50%2C25&cropresize=1&client_id=bpeditorial&sign=795d6935ad938faddaa6c97c7fd135bd5da59024c847fd1ca8e229ea41d4a868',
            'country' => 'Je sais pas je me suis endormi',
            'reference' => 'Derrick'],
            ['title' => 'It follow',
            'summary' => 'Celui là je l\'ai vue.. j\'ai pas dormi pendant deux semaines',
            'category' => 'Horreur',
            'year' => '2015',
            'poster' => 'https://fr.web.img6.acsta.net/pictures/14/12/08/15/41/424397.jpg',
            'country' => 'Un pays random',
            'reference' => 'It_Follow']
            ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach (self::PROGRAM as $programName => $infos) {
            $program = new Program();
            $program->setTitle($infos['title']);
            $program->setSummary($infos['summary']);
            $program->setPoster($infos['poster']);
            $program->setCategory($this->getReference('category_'.$infos['category']));
            $this->addReference('program_' . $faker->unique()->numberBetween(1, 12), $program);
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
