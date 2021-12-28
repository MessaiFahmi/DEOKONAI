<?php

use Deokonai\Http\Controllers\Admin\AdminController;
use Deokonai\Http\Controllers\Admin\BanController;
use Deokonai\Http\Controllers\Admin\ImageController;
use Deokonai\Http\Controllers\Admin\LogController;
use Deokonai\Http\Controllers\Admin\PageController;
use Deokonai\Http\Controllers\Admin\PermissionController;
use Deokonai\Http\Controllers\Admin\PostController;
use Deokonai\Http\Controllers\Admin\RoleController;
use Deokonai\Http\Controllers\Admin\SettingsController;
use Deokonai\Http\Controllers\Admin\UpdateController;
use Deokonai\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;



$middleware = [ 
    \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
]; 


/**
 * Admin routes
 */
Route::prefix('admin')->middleware(['auth','can:admin-pannel'])->group(function () {
 
    Route::get('/', [AdminController::class, 'index'])->name('index'); // Index



    /**
     * Update routes
     */
    Route::prefix('update')->group(function () {

        Route::get('/', [UpdateController::class, 'index'])->name('update.index'); // Index
        Route::post('/update', [UpdateController::class, 'update'])->name('update.update'); // Update

    });



    /**
     * Images routes
     */
    Route::prefix('images')->group(function () {

        Route::get('/', [ImageController::class, 'index'])->name('images.index'); // List
        Route::any('/create', [ImageController::class, 'create'])->name('images.create'); // Create
        Route::any('/edit/{id}', [ImageController::class, 'edit'])->name('images.edit'); // Edit
        Route::any('/delete/{id}', [ImageController::class, 'delete'])->name('images.delete'); // Delete

    });



    /**
     * Settings routes
     */
    Route::prefix('settings')->group(function () {

        Route::get('/', [SettingsController::class, 'index'])->name('settings.index'); // Index
        Route::any('/seo', [SettingsController::class, 'seo'])->name('settings.seo'); // SEO
        Route::any('/mail', [SettingsController::class, 'mail'])->name('settings.mail'); // Mail
        Route::any('/performance', [SettingsController::class, 'performance'])->name('settings.performance'); // Performance
        Route::any('/maintenance', [SettingsController::class, 'maintenance'])->name('settings.maintenance'); // Social
        Route::any('/social', [SettingsController::class, 'social'])->name('settings.social'); // Social

    });



    /**
     * Navigation
     */
    Route::prefix('navigation')->group(function () {

        // Route::get('/', [NOCONTROLLER::class, 'index'])->name('navigation.index'); // Index
        // Route::any('/create', [NOCONTROLLER::class, 'create'])->name('navigation.create'); // Create
        // Route::any('/delete/{id}', [NOCONTROLLER::class, 'delete'])->name('navigation.delete'); // Delete

    });



    /**
     * Users routes
     */
    Route::prefix('users')->group(function () {

        Route::get('/', [UserController::class, 'index'])->name('users.index'); // Index
        Route::any('/create', [UserController::class, 'create'])->name('users.create'); // Create
        Route::any('/edit/{id}', [UserController::class, 'edit'])->name('users.edit'); // Edit
        Route::any('/delete/{id}', [UserController::class, 'delete'])->name('users.delete'); // Delete
        Route::any('/show/{id}', [UserController::class, 'show'])->name('users.show'); // Show

    });



    /**
     * Roles routes
     */
    Route::prefix('roles')->group(function () {

        Route::get('/', [RoleController::class, 'index'])->name('roles.index'); // Index
        Route::any('/create', [RoleController::class, 'create'])->name('roles.create'); // Create
        Route::any('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit'); // Edit
        Route::any('/delete/{id}', [RoleController::class, 'delete'])->name('roles.delete'); // Delete
        Route::any('/show/{id}', [RoleController::class, 'show'])->name('roles.show'); // Show

    });



    /**
     * Bans routes
     */
    Route::prefix('bans')->group(function () {

        Route::get('/', [BanController::class, 'index'])->name('bans.index'); // Index
        Route::any('/create', [BanController::class, 'create'])->name('bans.create'); // Create
        Route::any('/edit/{id}', [BanController::class, 'edit'])->name('bans.edit'); // Edit
        Route::any('/delete/{id}', [BanController::class, 'delete'])->name('bans.delete'); // Delete
        Route::any('/show/{id}', [BanController::class, 'show'])->name('bans.show'); // Show

    });



    /**
     * Pages routes
     */
    Route::prefix('pages')->group(function () {

        Route::get('/', [PageController::class, 'index'])->name('pages.index'); // Index
        Route::any('/create', [PageController::class, 'create'])->name('pages.create'); // Create
        Route::any('/edit/{id}', [PageController::class, 'edit'])->name('pages.edit'); // Edit
        Route::any('/delete/{id}', [PageController::class, 'delete'])->name('pages.delete'); // Delete

    });



    /**
     * Posts routes
     */
    Route::prefix('pages')->group(function () {

        Route::get('/', [PostController::class, 'index'])->name('posts.index'); // Index
        Route::any('/create', [PostController::class, 'create'])->name('posts.create'); // Create
        Route::any('/edit/{id}', [PostController::class, 'edit'])->name('posts.edit'); // Edit
        Route::any('/delete/{id}', [PostController::class, 'delete'])->name('posts.delete'); // Delete

    });



    /**
     * Logs routes
     */
    Route::prefix('logs')->group(function () {

        Route::get('/', [LogController::class, 'index'])->name('logs.index'); // Index

    });

    

});

