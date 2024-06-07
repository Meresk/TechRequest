<?php

use App\Controllers\AdminController;
use App\Controllers\ApplicationController;
use App\Controllers\AssignmentController;
use App\Controllers\CuratorController;
use App\Controllers\ExecutorController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;
use App\Kernel\Router\Route;
use App\Middleware\AdminMiddleware;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

// Маршруты(инстансы класса Route)
return [
    /**
     * [HomeController::class, 'index']) - массив который содержит путь до класса и метод этого класса, в данном случае index - это основной метод показа страницы home
     *  в нашем случае через каждый инстанс вызвав getAction мы поулчим - [HomeController::class, 'index']
     * */  
    Route::get('/', [HomeController::class, 'index'], [AuthMiddleware::class]),
    Route::get('/register', [RegisterController::class, 'index'], [AdminMiddleware::class]),
    Route::post('/register', [RegisterController::class, 'register']),
    Route::get('/login', [LoginController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/login', [LoginController::class, 'login']),
    Route::post('/logout', [LoginController::class, 'logout']),

    Route::get('/admin', [AdminController::class, 'index'], [AdminMiddleware::class]),
    Route::post('/admin/users/destroy', [AdminController::class, 'destroy'], [AdminMiddleware::class]),

    Route::get('/applications/add', [ApplicationController::class, 'create'], [AuthMiddleware::class]),
    Route::post('/applications/add', [ApplicationController::class, 'store'], [AuthMiddleware::class]),
    Route::post('/applications/destroy', [ApplicationController::class, 'destroy'], [AuthMiddleware::class]),
    Route::get('/applications/update', [ApplicationController::class, 'edit'], [AuthMiddleware::class]),
    Route::post('/applications/update', [ApplicationController::class, 'update'], [AuthMiddleware::class]),
    Route::get('/applications/info', [ApplicationController::class, 'info'], [AuthMiddleware::class]),

    Route::get('/curator', [CuratorController::class, 'index'], [AuthMiddleware::class]),

    Route::get('/executor', [ExecutorController::class, 'index'], [AuthMiddleware::class]),

    Route::get('/assignments/add', [AssignmentController::class, 'create'], [AuthMiddleware::class]),
    Route::post('/assignments/add', [AssignmentController::class, 'upsert'], [AuthMiddleware::class]),
];