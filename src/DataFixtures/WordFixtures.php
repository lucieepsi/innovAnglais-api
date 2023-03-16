<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Word;
use App\Entity\Category;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class WordFixtures extends Fixture
{
    private $faker;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->faker=Factory::create("fr_FR");
 }

    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<8;$i++){
            $category = new Category();
            $category->setLabel($this->faker->word());
            $manager->persist($category);
            for($i1=0;$i1<100;$i1++){
                $word = new Word();
                $word->setLabel($this->faker->word())
                ->setTranslation($this->faker->word())
                ->addCategory($category);
                $this->setReference('word'.$i1+($i*100), $word);
                $manager->persist($word);
            }
        }
        $manager->flush();
    }
}