<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use JetBrains\PhpStorm\NoReturn;

class RegisterController extends Controller
{
    public function index(): void
    {
        $this->view(name: 'register', title: 'Регистрация');
    }

    #[NoReturn] public function register()
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:8'],
        ]);

        if (!$validation){
            foreach($this->request()->errors() as $field => $errors){
                $this->session()->set($field, $errors);
            }

            $this->redirect('/register');
        }

        //dd($this->request());
        
        $this->db()->insert('users', [
            'name' => $this->request()->input('name'),
            'email' => $this->request()->input('email'),
            'password' => password_hash($this->request()->input('password'), PASSWORD_DEFAULT),
        ]);

        $this->redirect('/');
    }
}