<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\ApplicationService;
use App\Services\UserService;

class ExecutorController extends Controller
{
    /**
     * Основной метод отображения страницы home
     */
    public function index(): void
    {
        $applications = $this->db()->selectWithJoin(
            'applications.id',
            'assignments.application_id',
            ['executor_id' => $_SESSION['user_id']]
        );

        $users = new UserService($this->db());

        $this->view('executor/index', [
            'applications' => $applications,
            'users' => $users->all(),
        ], 'Управление');
    }
}