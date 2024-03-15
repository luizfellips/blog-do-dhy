<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagsController;

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

Route::middleware('auth')->group(function () {
    Route::get('/noticias/create', [NoticiaController::class, 'create'])->name('noticia.create');
    Route::get('/noticias/list', [NoticiaController::class, 'list'])->name('noticia.list');
    Route::post('/noticias', [NoticiaController::class, 'store'])->name('noticia.store');
    Route::get('/noticias/{id}/edit', [NoticiaController::class, 'edit'])->name('noticia.edit');

    Route::get('/authors/create', [AuthorController::class, 'create'])->name('author.create');
    Route::post('/authors', [AuthorController::class, 'store'])->name('author.store');
    Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('author.show');
    Route::delete('/authors/{author}', [AuthorController::class, 'destroy'])->name('author.destroy');

    Route::get('/tags/create', [TagsController::class, 'create'])->name('tags.create');
    Route::post('/tags', [TagsController::class, 'store'])->name('tags.store');
    Route::delete('/tags/{tag}', [TagsController::class, 'destroy'])->name('tags.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [NoticiaController::class, 'index'])->name('home');
Route::get('/noticias/{titulo}', [NoticiaController::class, 'showBySlug'])->name('noticia.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';
