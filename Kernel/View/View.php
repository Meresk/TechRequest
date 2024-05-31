<?php

namespace App\Kernel\View;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Exceptions\ViewNotFoundException;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Storage\StorageInterface;

/**
 * Класс для страничек
 * APP_PATH - глобальная константа 
 */
class View implements ViewInterface
{
    private string $title;

    public function __construct(
        private SessionInterface $session,
        private AuthInterface $auth,
        private StorageInterface $storage,
    ) {    
    }


    /**
     * Метод содержащий путь к указанной в $name странице и подключающий эту страницу через include_once
     */
    public function page(string $name, array $data = [], string $title = ''): void
    {
        $this->title = $title;

        $viewPath = APP_PATH . "/views/pages/$name.php";

        if (!file_exists($viewPath))
        {
            throw new ViewNotFoundException(message:"View $name not found");
        }

        /**
         * View - ключ/название переменной с передаваемым значением $this т.е инстанс класса View
         * после выполнения будет достпуна переменная $view которая будет сорежать объект класса View и данные
         * которые мы передадим в data
         */
        extract(array_merge($this->defaultData(), $data));

        include_once $viewPath;
    }

    public function component(string $name, array $data = []): void
    {
        $componentPath = APP_PATH . "/views/components/$name.php";

        if (!file_exists($componentPath))
        {
            echo "Component $name not found";
            return;
        }

        extract(array_merge($this->defaultData(), $data));

        include $componentPath;
    }

    private function defaultData(): array 
    {
        return [
            'view'=>$this,
            'session'=>$this->session,
            'auth'=>$this->auth,
            'storage'=>$this->storage,
        ];
    }

    public function title(): string
    {
        return $this->title;
    }
}