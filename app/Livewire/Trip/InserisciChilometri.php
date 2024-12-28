<?php

namespace App\Livewire\Trip;

use App\Services\CarService;
use App\Services\ClientService;
use App\Services\TripService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class InserisciChilometri extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $car_id;
    public $user_id;
    public $km_iniziali;
    public $km_finali;
    public $giorno;
    public $clients = [];

    public function inserisci(TripService $tripService)
    {
        $request = new Request();
        $request->car_id = $this->car_id;
        $request->user_id = $this->user_id;
        $request->giorno = $this->giorno;
        $request->kmPercorsi = (int) $this->km_finali - (int) $this->km_iniziali;
        $request->clients = $this->clients;
        $tripService->inserisciViaggio($request);

        $this->reset('car_id', 'user_id', 'km_iniziali', 'km_finali', 'giorno');
        $this->clients = [];
    }

    public function render(TripService $tripService, CarService $carService, UserService $userService, ClientService $clientService)
    {
        return view('livewire.trip.inserisci-chilometri', [
            'listaTuttiViaggi' => $tripService->listaTuttiViaggi(),
            'listaVetture' => $carService->listaVetture(),
            'listaOperatori' => $userService->listaOperatori(),
            'listaRagazzi' => $clientService->listaRagazzi()
        ])
            ->title('inserisci chilometri');
    }
}
