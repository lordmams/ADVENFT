<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const USER_REFERENCE = 'test_user';

    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
    ) { }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('test@test.com');
        $user->setPassword(
            $this->passwordHasher->hashPassword(
                $user,
                'password'
            )
        );

        $this->addReference(self::USER_REFERENCE, $user);
        $manager->persist($user);

        $manager->flush();
    }
}
