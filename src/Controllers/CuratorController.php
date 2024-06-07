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
        $applications = new ApplicationService($this->db());
        $users = new UserService($this->db());
        $assignments = new AssignmentService($this->db());

        // TODO: пишем костыль!!!
        $this->db()->selectWithJoin('applications.id', 'assignments.application_id');

        $this->view('curator/index', [
            'applications' => $applications->all(),
            'users' => $users->all(),
            'assignments' => $assignments->all(),
        ], 'Управление');
    }
}