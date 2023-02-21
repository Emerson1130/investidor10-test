<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/posts/preview/{id}', [PostController::class, 'preview'])->name('posts.preview');
    Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');
    Route::resource('posts', PostController::class)->only([
        'create', 'store', 'show', 'update', 'destroy'
    ]);
    Route::get('/dashboard', 'App\\Http\\Controllers\\Web\\DashboardController@index')->name('dashboard');
});

require __DIR__.'/auth.php';
