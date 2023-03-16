<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Test;
use App\Entity\Attempt;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\VarDumper\VarDumper;

class AttemptFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;

    public function __construct(){
        $this->faker=Factory::create("fr_FR");
    }

    public function load(ObjectManager $manager): void
    {
        $tests = $manager->getRepository(Test::class)->findAll();
        $users = $manager->getRepository(User::class)->findAll();
        foreach($tests as $test) {
            foreach($users as $user) {
                if(mt_rand(0,1)==1){
                    $attempt = new Attempt();
                    $attempt->setUser($user)
                        ->setTest($test)
                        ->setDateAttempt($this->faker->dateTimeBetween('-1 year'))
                        ->setScore($this->faker->numberBetween(0, 20));
                    $manager->persist($attempt);
                }
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            TestFixtures::class,
        ];
    }
}
