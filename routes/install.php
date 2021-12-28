<?php

use Deokonai\Http\Controllers\InstallController;
use Illuminate\Support\Facades\Route;

$middleware = [ 
    \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
]; 

Route::middleware($middleware)->group(function () {

    Route::get('/', [InstallController::class, 'index'])->name('index');

    Route::any('/database', [InstallController::class, 'database'])->name('database');

    Route::any('/admin_user', [InstallController::class, 'admin_user'])->name('admin_user');

    Route::any('/finish', [InstallController::class, 'finish'])->name('finish');
});
