<?php

namespace App\Livewire\Car;

use App\Services\CarService;
use Livewire\Component;

class InserisciVettura extends Component
{
    public $nomeVettura;

    public function inserisci(CarService $carService)
    {
        $carService->inserisci($this->nomeVettura);
    }

    public function elimina(CarService $carService, $id)
    {
        $carService->elimina($id);
        session()->flash('status', 'vettura eliminata');
        $this->redirectRoute('car-inserisci', navigate: true);
    }

    public function render(CarService $carService)
    {
        return view('livewire.car.inserisci-vettura', [
            'listaVetture' => $carService->listaVetture()
        ])
            ->title('inserisci vettura');
    }
}
