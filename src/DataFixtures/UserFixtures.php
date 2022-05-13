<?php

namespace App\DataFixtures;

use App\Entity\Proprietaire;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $users = [];

        $user = new User();
        $user->setEmail("admin@admin.fr");
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'admin'
        ));
        $user->setRoles(["ROLE_ADMIN"]);

        $manager->persist($user);

        $users[] = $user;

        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setEmail($faker->freeEmail);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'password'
            ));
            $manager->persist($user);

            $users[] = $user;
        }

        for ($i = 0; $i < 20; $i++) {
            $proprietaire = new Proprietaire();
            $proprietaire->setNom($faker->lastName);
            $proprietaire->setPrenom(($faker->firstName()));
            $proprietaire->setDateDeNaissance($faker->dateTime());
            $proprietaire->setVille($faker->city);
            $proprietaire->setEmail($faker->freeEmail);

            $manager->persist($proprietaire);
        }

       


        $manager->flush();
    }
}
