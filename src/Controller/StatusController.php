<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TaskRepository;
use App\Entity\Status;
use App\Entity\Task;
use App\Form\TaskType;
use App\Form\StatusType;

class StatusController extends AbstractController
{
    /**
     * @Route("/status/{id}", name="app_status")
     */
    public function index(Request $request, EntityManagerInterface $entityManager, TaskRepository $taskRepository, $id)
    {

        $task = $taskRepository->find($id);

        if (!$task) {
            throw $this->createNotFoundException('Task not found');
        }

        $form = $this->createForm(StatusType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Status updated successfully.');
            return $this->redirectToRoute("app_tasks");
        }


        return $this->render('status/index.html.twig', [
            'task' => $task, 
            'form' => $form->createView(), 
        ]);
    }
}
