<?php

use Illuminate\Support\Facades\Route;

//Route::view('/', 'welcome');
Route::get('/', \App\Livewire\Home::class)->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/listaOperatori', \App\Livewire\ListaOperatori::class)->name('lista-operatori');
    Route::get('/modificaUser/{user}', \App\Livewire\User\ModificaUser::class)->name('user-modifica');
    Route::get('/inserisciVettura', \App\Livewire\Car\InserisciVettura::class)->name('car-inserisci');
});






Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
