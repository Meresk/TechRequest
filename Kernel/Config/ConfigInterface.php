<?php

namespace App\Kernel\Config;

interface ConfigInterface
{
    /**
     * Метод получения конфигурационных данных из файла посредством указания файл.параметр(реализация может быть изменена)
     */
    public function get(string $key, $default = null): mixed;
}