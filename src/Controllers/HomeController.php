<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\ApplicationService;

class HomeController extends Controller
{
    /**
     * Основной метод отображения страницы home
     */
    public function index(): void
    {
        $applications = new ApplicationService($this->db());
        $this->view('home', [
            'applications' => $applications->getApplicationsByUser(),
        ], 'Главная страница');
    }
}