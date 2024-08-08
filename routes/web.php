<?php

use App\Http\Controllers\AnecdoteController;
use App\Models\anecdote;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/anecdote/create', [AnecdoteController::class, 'create'])->name('anecdote.create');
Route::post('/anecdote/store', [AnecdoteController::class, 'store'])->name('anecdote.store');
Route::get('/anecdotes', [AnecdoteController::class, 'index'])->name('anecdotes');
Route::get('/anecdote/{id}', [AnecdoteController::class, 'show'])->name('anecdote.show');


Route::get('/', function () {

    $anecdotes = Anecdote::orderBy('created_at', 'asc')->get();
    return view('book', compact('anecdotes'));
});


Route::post('/download-pdf', [AnecdoteController::class, 'downloadPDF']);