<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\ApplicationService;
use App\Services\AssignmentService;
use App\Services\UserService;

class CuratorController extends Controller
{
    /**
     * Основной метод отображения страницы home
     */
    public function index(): void
    {
        $users = new UserService($this->db());
        $applications = $this->db()->selectWithJoin('applications.id', 'assignments.application_id');
        $sortBy = $this->request()->input('sortBy');

        $this->view('curator/index', [
            'applications' => $applications,
            'users' => $users->all(),
            'sortBy' => $sortBy,
        ], 'Управление');
    }
}