<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;
use App\Services\MovieService;

class AdminController extends Controller
{
    public function index(): void
    {


        $this->view('admin/index', [

        ]);
    }
}