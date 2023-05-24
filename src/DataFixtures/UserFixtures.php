<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Company;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->faker=Factory::create("fr_FR");
        $this->passwordHasher= $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 8; $i++) {
            $company = new Company();
            $company->setLabel($this->faker->word());
            $manager->persist($company);
            
            for ($j = 0; $j < 5; $j++) {
                $user = new User();
                if($i==0 && $j==0){
                    $user->setLastname("Slam")
                    ->setFirstname("Jury")
                    ->setRoles(array('ROLE_USER'))
                    ->setEmail("jury.slam@epsi.fr")
                    ->setPassword($this->passwordHasher->hashPassword(
                        $user, 
                        "Gr0upe2epsi*"
                    ))
                    ->AddCompany($company);
                }else{
                    $user->setLastname($this->faker->lastName())
                    ->setFirstname($this->faker->firstName())
                    ->setRoles(array('ROLE_USER'))
                    ->setEmail(strtolower($user->getFirstname()).'.'
                    .strtolower($user->getLastname())
                    .'@'.$this->faker->freeEmailDomain())
                    ->setPassword($this->passwordHasher->hashPassword(
                        $user, 
                        strtolower($user->getFirstname())
                    ))
                    ->AddCompany($company);
                }
                $nModule = mt_rand(1,13);
                for($r=0; $r<$nModule; $r++){
                    $user->addModule($this->getReference('module'.$r));
                }
                $manager->persist($user);
            }
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            TestFixtures::class,
        ];
    }
}
