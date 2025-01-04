<?php

namespace App\Livewire\Car;

use App\Services\CarService;
use App\Services\LogService;
use Livewire\Component;

class InserisciVettura extends Component
{
    public $nomeVettura;

    public function inserisci(CarService $carService, LogService $logService)
    {
        $carService->inserisci($this->nomeVettura);

        $tipo = 'inserimento vettura';
        $data = 'Vettura: '.$this->nomeVettura.' inserita';
        $logService->scriviLog(auth()->id(), $tipo, $data);

        $this->reset('nomeVettura');

        $this->dispatch('info', [
            'title' => 'Inserita Vettura',
        ]);
    }

    public function elimina(CarService $carService, LogService $logService, $id)
    {
        $carDaInviareALog = $carService->elimina($id);

        $tipo = 'eliminazione vettura';
        $data = 'vettura: '.$carDaInviareALog->name.' eliminata';
        $logService->scriviLog(auth()->id(), $tipo, $data);

        $this->dispatch('info', [
            'title' => 'Eliminata Vettura',
        ]);
    }

    public function render(CarService $carService)
    {
        return view('livewire.car.inserisci-vettura', [
            'listaVetture' => $carService->listaVetture()
        ])
            ->title('inserisci vettura');
    }
}
