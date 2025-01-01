<?php

use Illuminate\Support\Facades\Route;

//Route::view('/', 'welcome');
Route::get('/', \App\Livewire\Home::class)->name('home');
Route::get('/calcoloSaldo', \App\Livewire\CalcoloSaldo::class)->name('calcolo-saldo');

Route::middleware(['auth'])->group(function () {
    //------------------- USER ----------------------//
    Route::get('/listaOperatori', \App\Livewire\User\ListaOperatori::class)->name('lista-operatori');
    Route::get('/modificaUser/{user}', \App\Livewire\User\ModificaUser::class)->name('user-modifica');
    Route::get('/presenzeOperatori', \App\Livewire\User\PresenzeOperatori::class)->name('presenze-operatori');
    Route::get('/associaOperatoreOre', \App\Livewire\User\AssociaOperatoreOresettimanali::class)->name('operatore-ore-associa');
    Route::get('/presenzeAttivita', \App\Livewire\Client\PresenzeAttivita::class)->name('presenze-attivita');


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

    //------------------- LOG ----------------------//
    Route::get('/listaLog', \App\Livewire\Log\ListaLog::class)->name('log-lista');

    //------------------- RICEVUTE ----------------------//
    Route::get('/inserisciRicevuta', \App\Livewire\Ricevute\InserisciRicevuta::class)->name('ricevute-inserisci');

    //------------------- AGRICOLTURA ----------------------//
    Route::get('/agricoltura', \App\Livewire\Agricoltura\Agricoltura::class)->name('agricoltura');

    //------------------- STATISTICHE ----------------------//
    Route::get('/statistichePresenzeRagazzi', \App\Livewire\Statistiche\PresenzeRagazzi::class)->name('statistiche-presenze-ragazzi');
    Route::get('/statistichePresenzeOperatori', \App\Livewire\Statistiche\PresenzeOperatori::class)->name('statistiche-presenze-operatori');
    Route::get('/statisticheChilometriVetture', \App\Livewire\Statistiche\ChilometriVetture::class)->name('statistiche-chilometri-vetture');
    Route::get('/statisticheChilometriRagazzi', \App\Livewire\Statistiche\ChilometriRagazzi::class)->name('statistiche-chilometri-ragazzi');
});






Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
