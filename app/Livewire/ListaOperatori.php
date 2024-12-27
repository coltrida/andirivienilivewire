<?php

namespace App\Livewire;

use App\Services\UserService;
use Livewire\Component;

class ListaOperatori extends Component
{

    public function eliminaUser(UserService $userService, $id)
    {
        $userService->eliminaUser($id);
        session()->flash('status', 'Utente eliminato');
        $this->redirectRoute('lista-operatori', navigate: true);
    }


    public function render(UserService $userService)
    {
        return view('livewire.lista-operatori', [
            'listaOperatori' => $userService->listaOperatori()
        ])->title('lista operatori');
    }
}
