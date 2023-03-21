<?php

namespace App\DataFixtures;

use App\Entity\Status;
use App\Entity\User;
use App\Entity\Task;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $statusNew = new Status();
        $statusNew->setLabel('New');
        $manager->persist($statusNew);

        $statusInProgress = new Status();
        $statusInProgress->setLabel('In progress');
        $manager->persist($statusInProgress);

        $statusDone = new Status();
        $statusDone->setLabel('Done');
        $manager->persist($statusDone);

        $user = new User();
        $user->setEmail('jean.do@gmail.com');
        $user->setFirstName('Jean');
        $user->setLastName('Do');
        $manager->persist($user);

        $task = new Task();
        $task->setTitle('Task 1');
        $task->setContent('Content 1');
        $task->setCreatedAt(new \DateTimeImmutable('2023-02-21 09:04:00'));
        $task->setUpdatedAt(new \DateTimeImmutable('2023-02-21 09:04:00'));
        $task->setCompletedAt(new \DateTimeImmutable('2023-05-15 09:04:00'));
        $task->setStatus($statusNew);
        $task->addUser($user);
        $manager->persist($task);

        $manager->flush();
    }
}
