<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    /*public const EPISODE = 
    [
        ['title' => 'Pilot',
        'number' => '1',
        'synopsis' => 'Diagnosed with terminal lung cancer, chemistry teacher Walter White teams up with former student Jesse Pinkman to cook and sell crystal meth.',
        'season' => '1',
        'program' => 'Breaking_Bad'],
        ['title' => 'Cat\'s in the Bag...',
        'number' => '2',
        'synopsis' => 'After their first drug deal goes terribly wrong, Walt and Jesse are forced to deal with a corpse and a prisoner. Meanwhile, Skyler grows suspicious of Walt\'s activities.',
        'season' => '1',
        'program' => 'Breaking_Bad'],
        ['title' => '...And the Bag\'s in the River',
        'number' => '3',
        'synopsis' => 'Walt and Jesse clean up after the bathtub incident before Walt decides what course of action to take with their prisoner Krazy-8.',
        'season' => '1',
        'program' => 'Breaking_Bad'],
        ['title' => 'Seven Thirty-Seven',
        'number' => '1',
        'synopsis' => 'Walt and Jesse realize how dire their situation is. They must come up with a plan to kill Tuco before Tuco kills them first.',
        'season' => '2',
        'program' => 'Breaking_Bad'],
        ['title' => 'Grilled',
        'number' => '2',
        'synopsis' => 'Walt\'s disappearance is met with investigation by both his wife and Hank, as Tuco Salamanca intends to leave town with his kidnapped cooks.',
        'season' => '2',
        'program' => 'Breaking_Bad'],
        ['title' => 'Bit by a Dead Bee',
        'number' => '3',
        'synopsis' => 'Walt and Jesse try to come up with alibis for their disappearances.',
        'season' => '2',
        'program' => 'Breaking_Bad'],
        ['title' => 'Winter Is Coming',
        'number' => '1',
        'synopsis' => 'Eddard Stark is torn between his family and an old friend when asked to serve at the side of King Robert Baratheon; Viserys plans to wed his sister to a nomadic warlord in exchange for an army.',
        'season' => '1',
        'program' => 'Game_of_Thrones'],
        ['title' => 'The Kingsroad',
        'number' => '2',
        'synopsis' => 'While Bran recovers from his fall, Ned takes only his daughters to King\'s Landing. Jon Snow goes with his uncle Benjen to the Wall. Tyrion joins them.',
        'season' => '1',
        'program' => 'Game_of_Thrones'],
        ['title' => 'Lord Snow',
        'number' => '3',
        'synopsis' => 'Jon begins his training with the Night\'s Watch; Ned confronts his past and future at King\'s Landing; Daenerys finds herself at odds with Viserys.',
        'season' => '1',
        'program' => 'Game_of_Thrones'],
        ['title' => 'The North Remembers',
        'number' => '1',
        'synopsis' => 'Tyrion arrives at King\'s Landing to take his father\'s place as Hand of the King. Stannis Baratheon plans to take the Iron Throne for his own. Robb tries to decide his next move in the war. The Night\'s Watch arrive at the house of Craster.',
        'season' => '2',
        'program' => 'Game_of_Thrones'],
        ['title' => 'The Night Lands',
        'number' => '2',
        'synopsis' => 'Arya makes friends with Gendry. Tyrion tries to take control of the Small Council. Theon arrives at his home, Pyke, in order to persuade his father into helping Robb with the war. Jon tries to investigate Craster\'s secret.',
        'season' => '2',
        'program' => 'Game_of_Thrones'],
        ['title' => 'What Is Dead May Never Die',
        'number' => '3',
        'synopsis' => 'Tyrion tries to see who he can trust in the Small Council. Catelyn visits Renly to try and persuade him to join Robb in the war. Theon must decide if his loyalties lie with his own family or with Robb.',
        'season' => '2',
        'program' => 'Game_of_Thrones'],
        ['title' => 'Valar Dohaeris',
        'number' => '1',
        'synopsis' => 'Jon is brought before Mance Rayder, the King Beyond the Wall, while the Night\'s Watch survivors retreat south. In King\'s Landing, Tyrion asks for his reward. Littlefinger offers Sansa a way out.',
        'season' => '3',
        'program' => 'Game_of_Thrones'],
        ['title' => 'Dark Wings, Dark Words',
        'number' => '2',
        'synopsis' => 'Bran and company meet Jojen and Meera Reed. Arya, Gendry, and Hot Pie meet the Brotherhood. Jaime travels through the wilderness with Brienne. Sansa confesses her true feelings about Joffery to Margaery.',
        'season' => '3',
        'program' => 'Game_of_Thrones'],
        ['title' => 'Walk of Punishment',
        'number' => '3',
        'synopsis' => 'Robb and Catelyn arrive at Riverrun for Lord Hoster Tully\'s funeral. Tywin names Tyrion the new Master of Coin. Arya says goodbye to Hot Pie. The Night\'s Watch returns to Craster\'s. Brienne and Jaime are taken prisoner.',
        'season' => '3',
        'program' => 'Game_of_Thrones'],
    ];*/

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 120; $i++) {
            $episode = new Episode();

            $episode->setTitle($faker->sentence());
            $episode->setNumber($faker->numberBetween(1, 10));
            $episode->setSynopsis($faker->paragraph(3, true));
            $episode->setSeason($this->getReference('season_'. $faker->numberBetween(1, 60)));
            $manager->persist($episode);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }
}