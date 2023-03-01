<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Cassandra\Date;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Types\DateImmutableType;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $task = new Task();
        $task->setTitle("Create web");
        $task->setDescription("This is only a test");
        $task->setCreatedAt(\DateTimeImmutable::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
        $manager->persist($task);
        $manager->flush();
    }
}
