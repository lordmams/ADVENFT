<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EventFixtures extends Fixture
{
    public const CHRISTMAS_EVENT = "christmas";

    public function load(ObjectManager $manager): void
    {
        $event = new Event();
        $event->setStartDate(new \DateTime('2021-12-01'));
        $event->setEndDate(new \DateTime('2021-12-24'));
        $event->setTitle("Noël");

        $this->addReference(self::CHRISTMAS_EVENT, $event);
        $manager->persist($event);

        $manager->flush();
    }
}
