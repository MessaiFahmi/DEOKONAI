<?php

use Deokonai\Http\Controllers\Admin\AdminController;
use Deokonai\Http\Controllers\Admin\ImageController;
use Deokonai\Http\Controllers\Admin\SettingsController;
use Deokonai\Http\Controllers\PagesController;
use Deokonai\Http\Controllers\PostController;
use Deokonai\Http\Controllers\Admin\UpdateController;
use Deokonai\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/**
 *  Routes
 */
Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/home', [PagesController::class, 'home'])->name('home');


/**
 * Auth routes
 */
Auth::routes();



/**
 * Posts routes
 */
Route::prefix('posts')->group(function() {

    Route::get('/', [PostController::class, 'index']) // List
        ->name('posts.index');
    Route::any('/show/{id}', [PostController::class, 'show']) // Show
        ->name('posts.show');
    
});



/**
 * Profiles routes
 */
Route::prefix('profiles')->group(function() {

    Route::get('/', [ProfileController::class, 'index']) // List
        ->name('profiles.index');
    
    Route::prefix('me')->middleware('auth')->group(function () {

        Route::get('/', [ProfileController::class, 'me']) // Profile of logged user
            ->name('profiles.me.index');
        Route::any('/edit', [ProfileController::class, 'meEdit']) // Edit profile of logged user
            ->name('profiles.me.edit');
        Route::any('/delete', [ProfileController::class, 'meDelete']) // Delete profile of logged user
            ->name('profiles.me.delete');

    });

    Route::any('/show/{id}', [ProfileController::class, 'show']) // Show
        ->name('profiles.show');

});