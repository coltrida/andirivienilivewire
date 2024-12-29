<?php

use Illuminate\Support\Facades\Route;

//Route::view('/', 'welcome');
Route::get('/', \App\Livewire\Home::class)->name('home');

Route::middleware(['auth'])->group(function () {
    //------------------- USER ----------------------//
    Route::get('/listaOperatori', \App\Livewire\User\ListaOperatori::class)->name('lista-operatori');
    Route::get('/modificaUser/{user}', \App\Livewire\User\ModificaUser::class)->name('user-modifica');
    Route::get('/presenzeOperatori', \App\Livewire\User\PresenzeOperatori::class)->name('presenze-operatori');
    Route::get('/associaOperatoreOre', \App\Livewire\User\AssociaOperatoreOresettimanali::class)->name('operatore-ore-associa');


    //------------------- CAR ----------------------//
    Route::get('/inserisciVettura', \App\Livewire\Car\InserisciVettura::class)->name('car-inserisci');

    //------------------- CLIENT ----------------------//
    Route::get('/inserisciRagazzo', \App\Livewire\Client\InserisciRagazzo::class)->name('client-inserisci');
    Route::get('/modificaRagazzo/{client}', \App\Livewire\Client\ModificaRagazzo::class)->name('client-modifica');

    //------------------- ATTIVITA ----------------------//
    Route::get('/inserisciAttivita', \App\Livewire\Activity\InserisciAttivita::class)->name('activity-inserisci');
    Route::get('/associaAttivitaRagazzo', \App\Livewire\Activity\AssociaAttivitaRagazzo::class)->name('activity-client-associa');

    //------------------- TRIP ----------------------//
    Route::get('/inserisciChilometri', \App\Livewire\Trip\InserisciChilometri::class)->name('viaggio-inserisci');
});






Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
