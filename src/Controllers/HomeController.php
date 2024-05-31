<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\MovieService;

class HomeController extends Controller
{
    /**
     * Основной метод отображения страницы home
     */
    public function index(): void
    {
        $this->view('home', [

        ], 'Главная страница');
    }
}