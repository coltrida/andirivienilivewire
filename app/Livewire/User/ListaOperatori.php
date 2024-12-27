<?php

namespace App\Livewire\User;

use App\Services\UserService;
use Illuminate\Http\Request;
use Livewire\Component;

class ListaOperatori extends Component
{
    public $name;
    public $email;
    public $oresettimanali;
    public $password;

    public function inserisci(UserService $userService)
    {
        $request = new Request();
        $request->name = $this->name;
        $request->email = $this->email;
        $request->oresettimanali = $this->oresettimanali;
        $request->password = $this->password;
        $userService->inserisciUser($request);

        $this->reset('name');
        $this->reset('email');
        $this->reset('oresettimanali');
        $this->reset('password');
    }

    public function eliminaUser(UserService $userService, $id)
    {
        $userService->eliminaUser($id);
        session()->flash('status', 'Utente eliminato');
        $this->redirectRoute('lista-operatori', navigate: true);
    }


    public function render(UserService $userService)
    {
        return view('livewire.user.lista-operatori', [
            'listaOperatori' => $userService->listaOperatori()
        ])->title('lista operatori');
    }
}
