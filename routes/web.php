<?php

use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [NoticiaController::class, 'index'])->name('home');
Route::get('/noticias/{titulo}', [NoticiaController::class, 'showBySlug'])->name('noticia.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/noticias', [NoticiaController::class, 'store'])->name('noticia.store');
    Route::get('/noticias/create', [NoticiaController::class, 'create'])->name('noticia.create');
    Route::get('/author/create', [AuthorController::class, 'create'])->name('author.create');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
