<?php

namespace App\Kernel\Router;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Storage\StorageInterface;
use App\Kernel\View\ViewInterface;
use App\Kernel\Middleware\AbstractMiddleware;

// Класс маршрутизатор
class Router implements RouterInterface
{
    /**
     * Массив где хранятся маршруты которые относятся к соответсвующей группе http метода
     *  */ 
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function __construct(
        private ViewInterface $view,
        private RequestInterface $request,
        private RedirectInterface $redirect,
        private SessionInterface $session,
        private DatabaseInterface $database,
        private AuthInterface $auth,
        private StorageInterface $storage,
    )
    {
        // вызываем метод initRoutes чтобы в момент инициализации могли сразу получить список маршрутов
        $this->initRoutes();
    }

    /**
     * Обработка маршрута на основе переданных uri и http-метода
     */
    public function dispatch(string $uri, string $method): void
    {   
        $route = $this->findRoute($uri, $method);

        /**
         * Если пользователь перешел по маршруту которого не существует
         */
        if(!$route)
        {
            $this->notFound();
        }

        /**
         * Проверка есть ли у маршрута посредники с их перебором, если есть вызоз метода handle и последующая проверка им
         */
        if($route->hasMiddlewares()){
            foreach($route->getMiddlewares() as $middleware) {
                /** @var AbstractMiddleware $middleware */
                $middleware = new $middleware($this->request, $this->auth, $this->redirect);

                $middleware->handle();
            }
        }

        // проверка если action является массивом это означет что маршрут связан с контроллером и мы передаем этот контроллер
        if(is_array($route->getAction()))
        {
            // в controller мы храним путь до класса
            [$controller, $action] = $route->getAction();

            /** @var Controller $controller */ 
            $controller = new $controller();
            
            // вызов метода setView у контроллера с передачей объекта view
            call_user_func([$controller, 'setView'], $this->view);
            // вызов метода setRequest у контроллера с передачей объекта requset
            call_user_func([$controller, 'setRequest'], $this->request);

            call_user_func([$controller, 'setRedirect'], $this->redirect);

            call_user_func([$controller, 'setSession'], $this->session);

            call_user_func([$controller, 'setDatabase'], $this->database);

            call_user_func([$controller, 'setAuth'], $this->auth);

            call_user_func([$controller, 'setStorage'], $this->storage);


            call_user_func([$controller, $action]);
        } 
        // если передаем анонимную функцию а не контроллер
        else 
        {
            call_user_func($route->getAction());
        }
    }

    /**
     * Вывод 404 
     */
    private function notFound(): void
    {
        echo '404 | Not Found';
        exit;
    }

    /**
     * Метод поиска маршрута в списке $routes
     * если маршрут не найден вернет false
     */
    private function findRoute(string $uri, string $method): Route|false
    {
        if(!isset($this->routes[$method][$uri]))
        {
            return false;
        }
        
        return $this->routes[$method][$uri];
    }

    /**
     * Метод который расфасовывает маршруты из файла routes.php по группам
     */
    private function initRoutes()
    {   
        // Получаем те маршруты, которые есть в файле
        $routes = $this->getRoutes();

        // перебераем объекты класса Route
        foreach ($routes as $route)
        {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    /**
     * Метод возвращает массив из Route объектов где содержатся все наши маршруты
     * @return Route[]
     */
    private function getRoutes(): array
    {
        // Переход в routes.php который по сути является одной функцией
        return require_once APP_PATH . '/config/routes.php';
    }
}