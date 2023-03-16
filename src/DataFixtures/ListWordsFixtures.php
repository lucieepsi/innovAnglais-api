<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\ListWords;
use App\Entity\Theme;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ListWordsFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->faker=Factory::create("fr_FR");
 }

    public function load(ObjectManager $manager): void
    {
        for($i0=0; $i0<3; $i0++){
            $theme = new Theme();
            $theme->setLabel($this->faker->word());
            $manager->persist($theme);
            for($i=0;$i<9;$i++){
                $listWords = new ListWords();
                $this->setReference('listWords'.($i+($i0*8)), $listWords);
                $listWords->addWord($this->getReference('word'.mt_rand(0,799)))
                ->setLabel($this->faker->word())
                ->setTheme($theme);
                $manager->persist($listWords);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            WordFixtures::class,
        ];
    }
}