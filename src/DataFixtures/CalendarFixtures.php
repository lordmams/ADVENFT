<?php

namespace App\DataFixtures;

use App\Entity\Calendar;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CalendarFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i <= 10; $i++) {
            $calendar = new Calendar();
            $calendar->setUser($this->getReference(UserFixtures::USER_REFERENCE));
            $calendar->setEvent($this->getReference(EventFixtures::CHRISTMAS_EVENT));
            $calendar->setHasDonation(true);
            $calendar->setTitle("Calendrier de l'avent #$i");

            $manager->persist($calendar);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            EventFixtures::class,
        ];
    }
}
