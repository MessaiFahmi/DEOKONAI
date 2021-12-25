<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\UpdateController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/**
 *  | Home route
 * -#------------
 */
Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/home', [PagesController::class, 'home'])->name('home');


/**
 *  | Login route
 * -#-------------
 */
Auth::routes();


/**
 *  | Admin routes
 * -#--------------
 */
Route::prefix('admin')->middleware(['auth','can:admin-pannel'])->group(function () {


 
    Route::get('/', [AdminController::class, 'index'])->name('admin.index'); // admin



    Route::prefix('update')->group(function () {



        Route::get('/', [UpdateController::class, 'index'])->name('admin.update.index'); // admin.update.index
        Route::post('/update', [UpdateController::class, 'update'])->name('admin.update.update'); // admin.update.update



    });



    Route::prefix('/images')->group(function () {


        
        Route::get('/', [ImageController::class, 'index'])->name('admin.images.index'); // admin/images
        Route::any('/create', [ImageController::class, 'create'])->name('admin.images.create'); // admin/images/create
        Route::any('/edit/{id}', [ImageController::class, 'edit'])->name('admin.images.edit'); // admin/images/edit
        Route::any('/delete/{id}', [ImageController::class, 'delete'])->name('admin.images.delete'); // admin/images/delete



    });



    Route::prefix('/settings')->group(function () {



        Route::get('/', [SettingsController::class, 'index'])->name('admin.settings.index'); // admin/settings
        // Route::post('/update', [SettingsController::class, 'update'])->name('admin.settings.update'); // admin/settings/update
        // Route::get('/delete/{id}', [SettingsController::class, 'delete'])->name('admin.settings.delete'); // admin/settings/delete
        // Route::get('/destroy/{id}', [SettingsController::class, 'destroy'])->name('admin.settings.destroy'); // admin/settings/destroy



    });




});


/**
 *  | Posts routes
 * -#--------------
 */
Route::prefix('posts')->group(function() {



    Route::get('/', [PostController::class, 'index']) // posts/
        ->name('posts.index');
    Route::any('/create', [PostController::class, 'create']) // posts/create
        ->middleware(['auth','can:posts-create'])
        ->name('posts.create');
    Route::any('/show/{id}', [PostController::class, 'show']) // posts/show/{id}
        ->name('posts.show');
    Route::any('/edit/{id}', [PostController::class, 'edit']) // posts/edit/{id}
        ->middleware(['auth','can:posts-edit'])
        ->name('posts.edit');
    Route::any('/delete/{id}', [PostController::class, 'delete']) // posts/delete/{id}
        ->middleware(['auth','can:posts-delete'])
        ->name('posts.delete');


    
});

