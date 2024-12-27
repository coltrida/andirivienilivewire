<?php

namespace App\Livewire\Car;

use App\Services\CarService;
use Livewire\Component;

class InserisciVettura extends Component
{


    public function elimina(CarService $carService, $id)
    {
        $userService->eliminaUser($id);
        session()->flash('status', 'Utente eliminato');
        $this->redirectRoute('lista-operatori', navigate: true);
    }

    public function render(CarService $carService)
    {
        return view('livewire.car.inserisci-vettura', [
            'listaVetture' => $carService->listaVetture()
        ])
            ->title('inserisci vettura');
    }
}
