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

class AttemptFixtures extends Fixture
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
                $attempt = new Attempt();
                $attempt->setTest($test)
                    ->setUser($user)
                    ->setDateAttempt($this->faker->dateTimeBetween('-1 year'))
                    ->setScore($this->faker->numberBetween(0, 20));
                $manager->persist($attempt);
            }
        }

        $manager->flush();
    }
}
