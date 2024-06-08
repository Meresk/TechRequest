<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\ApplicationService;
use App\Services\UserService;

class HomeController extends Controller
{
    /**
     * Основной метод отображения страницы home
     */
    public function index(): void
    {
        $applications = new ApplicationService($this->db());
        $users = new UserService($this->db());

        $this->view('home', [
            'applications' => $applications->getApplicationsByUser(),
            'executors' => $users->allExecutors(),
        ], 'Главная страница');
    }
}