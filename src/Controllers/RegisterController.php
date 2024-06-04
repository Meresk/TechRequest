<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\RoleService;
use JetBrains\PhpStorm\NoReturn;

class RegisterController extends Controller
{
    public function index(): void
    {
        $roles = new RoleService($this->db());

        $this->view('register', [
          'roles' => $roles->all()
        ], 'Регистрация');
    }

    #[NoReturn] public function register()
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:8'],
            'role' => ['required'],
        ]);

        if (!$validation){
            foreach($this->request()->errors() as $field => $errors){
                $this->session()->set($field, $errors);
            }

            $this->redirect('/register');
        }

        if($this->db()->insert('users', [
            'role_id' => $this->request()->input('role'),
            'name' => $this->request()->input('name'),
            'email' => $this->request()->input('email'),
            'password' => password_hash($this->request()->input('password'), PASSWORD_DEFAULT),
        ])){
            $this->redirect('/admin');
        }
        else{
            $this->redirect('/register');
        }
    }
}