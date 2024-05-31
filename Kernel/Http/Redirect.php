<?php

namespace App\Kernel\Http;

class Redirect implements RedirectInterface
{
    /**
     * Метод перенаправления по url
     */
    public function to(string $url)
    {
        header("Location: $url");
        exit;
    }
}