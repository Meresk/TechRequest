<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\ApplicationService;

class ApplicationController extends Controller
{
    private ApplicationService $service;

    public function create(): void
    {
        $this->view('applications/add', [

        ]);
    }

    public function store(): void
    {
        // TODO: добавить валидацию

        $this->service()->store(
            $this->request()->input('reason'),
            $this->request()->input('inventoryNumber'),
            $this->request()->input('inventoryPlace'),
            $this->request()->input('applicantComment'),
        );

        $this->redirect('/');
    }

    public function destroy(): void
    {
        $this->service()->delete($this->request()->input('id'));

        $this->redirect('/');
    }

    public function edit(): void
    {
        $application = $this->service()->find($this->request()->input('id'));

        $this->view('applications/update', [
            'application' => $application,
        ], "Заявка № {$application->id()}");
    }

    public function update(): void
    {
        //TODO: Добавить валидацию

        $this->service()->update(
            $this->request()->input('id'),
            $this->request()->input('reason'),
            $this->request()->input('inventoryNumber'),
            $this->request()->input('inventoryPlace'),
            $this->request()->input('applicantComment'),
        );

        $this->redirect('/');
    }

    public function info(): void
    {
        $application = $this->service()->find($this->request()->input('id'));

        $this->view('applications/info', [
            'application' => $application,
        ], "Заявка № {$application->id()}");
    }


    private function service(): ApplicationService
    {
        if (! isset($this->service)){
            $this->service = new ApplicationService($this->db());
        }

        return $this->service;
    }
}