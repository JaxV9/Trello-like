<?php

namespace App\Controller;

use App\Entity\Status;
use App\Entity\Task;
use App\Form\TaskType;
use App\Form\StatusType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class TasksController extends AbstractController
{
    /**
     * @Route("/tasks", name="app_tasks")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $tasks = $entityManager->getRepository(Task::class)->findAll();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($task);
            foreach($task->getUsers() as $user) {
                $entityManager->persist($user);
            }
            $entityManager->flush();

            return $this->redirectToRoute("app_tasks");
        }

        return $this->render('tasks/index.html.twig', [
            'MyFormTask' => $form->createView(),
            'tasks' => $tasks,
            'user' => $this->getUser(),
        ]);
    }

}
