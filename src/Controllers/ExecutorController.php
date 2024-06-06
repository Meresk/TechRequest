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
        $applications = new ApplicationService($this->db());
        $users = new UserService($this->db());

        $this->view('executor/index', [
            'applications' => $applications->all(),
            'users' => $users->all(),
        ], 'Управление');
    }
}