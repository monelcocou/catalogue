<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('gestionnaire@gmail.com');
        $user1->setPassword('123456');
        $user1->setRoles(['ROLE_GESTIONNAIRE']);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('admin@gmail.com');
        $user2->setPassword('123456');
        $user2->setRoles(['ROLE_ADMIN']);
        $manager->persist($user2);

        $manager->flush();
    }
}
