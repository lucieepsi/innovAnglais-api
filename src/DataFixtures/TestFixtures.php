<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Test;
use App\Entity\Module;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TestFixtures extends Fixture  implements DependentFixtureInterface
{
    private $faker;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->faker=Factory::create("fr_FR");
 }

 public function load(ObjectManager $manager): void
{
    for ($i = 0; $i < 3; $i++) {
        $module = new Module();
        $this->setReference('module'.$i, $module);
        $module->setLabel($this->faker->word());
        $manager->persist($module);
        for ($j = 0; $j < 8; $j++) {
            $test = new Test();
            $test->setModule($module)
                ->setLabel($this->faker->word())
                ->setLevel($this->faker->randomFloat(2, 1, 10))
                ->addList($this->getReference('listWords'.mt_rand(0,24)));
            $manager->persist($test);
            $this->addReference('test'.($j+1+($i*8)), $test);
        }
    }
 
    $manager->flush();
}
public function getDependencies()
    {
        return [
            ListWordsFixtures::class,
        ];
    }

    
}