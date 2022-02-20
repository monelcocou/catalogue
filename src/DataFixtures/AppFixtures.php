<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPassword;
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPassword = $userPasswordHasher;
    }

    public function crypteMonPassword(string $pass): string
    {
        return $this->userPassword->hashPassword(new User(), $pass);
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('gestionnaire@gmail.com');
        $user1->setPassword($this->crypteMonPassword('123456'));
        $user1->setRoles(['ROLE_GESTIONNAIRE']);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('admin@gmail.com');
        $user2->setPassword($this->crypteMonPassword('123456'));
        $user2->setRoles(['ROLE_ADMIN']);
        $manager->persist($user2);

        $manager->flush();
    }
}


