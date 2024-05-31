<?php

namespace App\Kernel\Controller;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Storage\StorageInterface;
use App\Kernel\View\ViewInterface;

abstract class Controller
{
    private ViewInterface $view;
    private RequestInterface $request;
    private RedirectInterface $redirect;
    private SessionInterface $session;
    private DatabaseInterface $database;
    private AuthInterface $auth;
    private StorageInterface $storage;

    /**
     * Метод принимающий название страницы и вызывающий метод page объекта view
     */
    public function view(string $name, array $data = [], string $title = ''): void
    {
        $this->view->page($name, $data, $title);
    }

    /**
     * Setter для страницы
     */
    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    public function request(): RequestInterface
    {
        return $this->request;
    }

    /**
     * Setter для запроса
     */
    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }

    // Редирект
    public function setRedirect(RedirectInterface $redirect)
    {
        $this->redirect = $redirect;
    }
    public function redirect(string $url): RedirectInterface
    {
        return $this->redirect->to($url);
    }

    // Сессии
    public function session(): SessionInterface
    {
        return $this->session;
    }
    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }

    // БД
    public function db(): DatabaseInterface
    {
        return $this->database;
    }
    public function setDatabase(DatabaseInterface $database): void
    {
        $this->database = $database;
    }

    // Аутентификация
    public function auth(): AuthInterface
    {
        return $this->auth;
    }
    public function setAuth(AuthInterface $auth): void
    {
        $this->auth = $auth;
    }

    public function storage(): StorageInterface
    {
        return $this->storage;
    }

    public function setStorage(StorageInterface $storage): void
    {
        $this->storage = $storage;
    }
}