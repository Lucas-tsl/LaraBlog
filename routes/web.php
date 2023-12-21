<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/articles/create', [UserController::class, 'create'])->name('articles.create');
Route::post('/articles/store', [UserController::class, 'store'])->name('articles.store');

// édiiton d'un article 

Route::get('/articles/{article}/edit', [UserController::class, 'edit'])->name('articles.edit');

// suppression d'un article 

Route::get('/articles/{article}/remove', [UserController::class, 'remove'])->name('articles.remove');


//  Mise à jour d'un article 
Route::post('/articles/{article}/update', [UserController::class, 'update'])->name('articles.update');









// doit être les dernières routes du projets pour ne pas interférer avec les autres
// Affiche la listes des articles publiés d'un utilisateur 
Route::get('/{user}', [PublicController::class, 'index'])->name('public.index');
Route::get('/{user}/{article}', [PublicController::class, 'show'])->name('public.show');