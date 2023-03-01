<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\TaskStatus;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Types\DateImmutableType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail("test@tst.com");
        $user->setPassword(
            $this->userPasswordHasher->hashPassword($user,"test")
        );
        $taskStatus = new TaskStatus(TaskStatus::STATUS_TO_START);
        $task= new Task();
        $task->setTitle("This is a Test");
        $task->setDescription("lorem impsum");
        $task->setTaskStatus($taskStatus);
        $task->setCreatedAt(\DateTimeImmutable::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
        $task->setUser($user);
        $manager->persist($taskStatus);
        $manager->persist($task);
        $manager->persist($user);

        $manager->flush();
    }
}
