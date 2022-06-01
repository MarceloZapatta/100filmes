<?php

use App\Http\Livewire\Diretor;
use App\Http\Livewire\DiretorEdit;
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
    Route::get('diretores/{teste?}/edit', DiretorEdit::class)->name('admin.diretores.edit');
});


require __DIR__.'/auth.php';
