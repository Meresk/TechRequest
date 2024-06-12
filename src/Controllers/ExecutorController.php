<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\ApplicationService;
use App\Services\AssignmentService;
use App\Services\UserService;

class ExecutorController extends Controller
{
    private AssignmentService $service;
    public function index(): void
    {
        $applications = $this->db()->selectWithJoin(
            'applications.id',
            'assignments.application_id',
            ['executor_id' => $_SESSION['user_id']]
        );

        $users = new UserService($this->db());
        $sortBy = $this->request()->input('sortBy');

        $this->view('executor/index', [
            'applications' => $applications,
            'users' => $users->all(),
            'sortBy' => $sortBy,
        ], 'Управление');
    }

    public function work(): void
    {
        $application = $this->service()->findApplication($this->request()->input('id'));
        $assignment = $this->service()->findAssignment($this->request()->input('id'));

        $this->view('executor/applications/work', [
            'application' => $application,
            'assignment' => $assignment,
        ]);
    }

    public function workUpdate(): void
    {
        $application = $this->service()->findApplication($this->request()->input('applicationId'));
        $this->db()->update('applications', [
            'status' => $this->request()->input('status'),
        ], [
            'id' => $application->id()
        ]);

        if($this->request()->input('closeReason') == null){
            $this->db()->update('assignments', [
                'executor_comment' => $this->request()->input('executorComment'),
            ], [
                'application_id' => $application->id()
            ]);
        }
        else {
            $this->db()->update('assignments', [
                'executor_comment' => $this->request()->input('executorComment'),
                'close_reason' => $this->request()->input('closeReason'),
            ], [
                'application_id' => $application->id()
            ]);
        }

        ;$this->redirect('/executor');
    }

    private function service(): AssignmentService
    {
        if (! isset($this->service)){
            $this->service = new AssignmentService($this->db());
        }

        return $this->service;
    }
}