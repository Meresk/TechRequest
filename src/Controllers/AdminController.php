<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\RoleService;
use App\Services\UserService;

class AdminController extends Controller
{
    private UserService $service;

    public function index(): void
    {
        $users = new UserService($this->db());
        $roles = new RoleService($this->db());

        $this->view('admin/index', [
            'users' => $users->all(),
            'roles' => $roles->all(),
        ]);
    }

    public function destroy(): void
    {
        $this->service()->delete($this->request()->input('id'));

        $this->redirect('/admin');
    }

    private function service(): UserService
    {
        if(! isset($this->service)){
            $this->service = new UserService($this->db());
        }

        return $this->service;
    }
}