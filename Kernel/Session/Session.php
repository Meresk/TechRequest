<?php

namespace App\Kernel\Session;


/**
 * Класс для сохранения состояния между страничками
 */
class Session implements SessionInterface
{
    public function __construct()
    {
        session_start();
    }

    /**
     * Добавить элемент в сессию
     */
    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    /**
     * Вернуть значение и удалить из сессии
     */
    public function getFlash(string $key, $default = null)
    {
        $value = $this->get($key, $default);
        $this->remove($key);

        return $value;
    }

    /**
     * Проверка наличия элемента в сессии
     */
    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Удаляет элемент в сессии
     */
    public function remove(string $key)
    {
        unset($_SESSION[$key]);
    }

    public function destroy()
    {
        session_destroy();
    }
}