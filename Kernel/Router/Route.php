<?php

namespace App\Kernel\Router;

//Маршрут
class Route
{
    public function __construct(
        private string $uri,
        private string $method,
        private $action,
        private array $middlewares = [],
    ) {
    }
    
    /**
     * Helper-функция позволяющая создавать инстанс класса Route с явным указаниям метода GET и действия - $action
     */
    public static function get(string $uri, $action, array $middlewares = []): static
    {
        return new static($uri, 'GET', $action, $middlewares);
    }

    /**
     * Helper-функция позволяющая создавать инстанс класса Route с явным указаниям метода POST и действия - $action
     */
    public static function post(string $uri, $action, array $middlewares = []): static
    {
        return new static($uri, 'POST', $action, $middlewares);
    }

    /**
     * Getter для получения uri у маршрута
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Getter для получения используемого метода у маршрута: GET, POST и т.д
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Getter для получения действия маршрута
     */
    public function getAction()
    {
        return $this->action;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function hasMiddlewares(): bool
    {
        return ! empty($this->middlewares);
    }
}