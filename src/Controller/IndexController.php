<?php

namespace App\Controller;

use App\Entity\Status;
use App\Entity\Task;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="app_index")
     */
    public function index(): Response
    {
        return $this->redirectToRoute('app_tasks');
    }

        /**
     * @Route("/", name="app_index")
     */
    public function index_2(): Response
    {
        return $this->redirectToRoute('app_tasks');
    }
}
