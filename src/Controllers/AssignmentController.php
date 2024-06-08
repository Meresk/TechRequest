<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\ApplicationService;
use App\Services\AssignmentService;
use App\Services\UserService;

class AssignmentController extends Controller
{
    private AssignmentService $service;

    public function create(): void
    {
        $application = $this->service()->findApplication($this->request()->input('id'));
        $users = new UserService($this->db());
        $assignment = $this->service()->findAssignment($this->request()->input('id'));

        $this->view('assignments/add', [
            'application' => $application,
            'executors' => $users->allExecutors(),
            'assignment' => $assignment,
        ], 'Управление');
    }

    public function upsert(): void
    {

        $this->service()->upsert(
            $this->request()->input('id'),
            $this->request()->input('applicationId'),
            $this->request()->input('executorId'),
        );

        $this->redirect('/curator');
    }

    private function service(): AssignmentService
    {
        if (! isset($this->service)){
            $this->service = new AssignmentService($this->db());
        }

        return $this->service;
    }
}