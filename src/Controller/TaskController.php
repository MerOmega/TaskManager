<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    #[Route('/', name: 'app_task')]
    public function index(TaskRepository $tasks): Response
    {
        return $this->render(
          "tasks/show_tasks.html.twig",
            [
                "tasks"=>$tasks->findAll(),
            ]
        );
    }
}
