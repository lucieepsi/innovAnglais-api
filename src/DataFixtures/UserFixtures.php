<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Company;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class UserFixtures extends Fixture
{
    private $faker;
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->faker=Factory::create("fr_FR");
        $this->passwordHasher= $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $company = new Company();
            $company->setLabel($this->faker->word());
            $manager->persist($company);

            for ($j = 0; $j < 2; $j++) {
                $user = new User();
                $user->setLastname($this->faker->lastName())
                    ->setFirstname($this->faker->firstName())
                    ->setRoles(array('ROLE_USER'))
                    ->setEmail(strtolower($user->getFirstname()).'.'.strtolower($user->getLastname()).'@'.$this->faker->freeEmailDomain())
                    ->setPassword($this->passwordHasher->hashPassword($user, strtolower($user->getFirstname())))
                    ->AddCompany($company);
                $manager->persist($user);
            }
        }

        $manager->flush();
    }
}
