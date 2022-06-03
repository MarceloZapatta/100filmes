<?php

use App\Http\Livewire\Diretor;
use App\Http\Livewire\DiretorEdit;
use App\Http\Livewire\Filme;
use App\Http\Livewire\FilmeEdit;
use App\Http\Livewire\Filmes;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group([
    'middleware' => 'auth',
    'prefix' => 'admin'
], function () {
    Route::get('diretores', Diretor::class)->name('admin.diretores.index');
    Route::get('diretores/criar', DiretorEdit::class)->name('admin.diretores.criar');
    Route::get('diretores/{diretor}/editar', DiretorEdit::class)->name('admin.diretores.editar');
    Route::get('filmes', Filme::class)->name('admin.filmes.index');
    Route::get('filmes/criar', FilmeEdit::class)->name('admin.filmes.criar');
    Route::get('filmes/{filme}/editar', FilmeEdit::class)->name('admin.filmes.editar');
});


require __DIR__.'/auth.php';
