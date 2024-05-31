<?php

use App\Controllers\AdminController;
use App\Controllers\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\MovieController;
use App\Controllers\RegisterController;
use App\Controllers\ReviewController;
use App\Kernel\Router\Route;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

// Маршруты(инстансы класса Route)
return [
    /**
     * [HomeController::class, 'index']) - массив который содержит путь до класса и метод этого класса, в данном случае index - это основной метод показа страницы home
     *  в нашем случае через каждый инстанс вызвав getAction мы поулчим - [HomeController::class, 'index']
     * */  
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/register', [RegisterController::class, 'index']),
    Route::post('/register', [RegisterController::class, 'register']),
    Route::get('/login', [LoginController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/login', [LoginController::class, 'login']),
    Route::post('/logout', [LoginController::class, 'logout']),
    Route::get('/admin', [AdminController::class, 'index'], [AuthMiddleware::class]),
];