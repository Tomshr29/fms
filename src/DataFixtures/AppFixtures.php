<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppUserFixture extends Fixture
{

    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('tomscherer29@example.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->hasher->hashPassword(
            $user,
            'password123'
        ));
        $manager->persist($user);
        $manager->flush();
    }
}