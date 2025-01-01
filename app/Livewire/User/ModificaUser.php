<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Services\LogService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Livewire\Component;

class ModificaUser extends Component
{
    public $email;
    public $oresettimanali;
    public $oresaldo;
    public $user;

    public function mount(User $user)
    {
        $this->email = $user->email;
        $this->oresettimanali = $user->oresettimanali;
        $this->oresaldo = $user->oresaldo;
        $this->user = $user;
    }

    public function modifica(UserService $userService, LogService $logService)
    {
        $request = new Request();
        $request->user = $this->user;
        $request->email = $this->email;
        $request->oresettimanali = $this->oresettimanali;
        $request->oresaldo = $this->oresaldo;

        $userService->modificaUser($request);
        session()->flash('status', 'Utente modificato');

        $tipo = 'modifica operatore';
        $data = 'modificato: '.$this->user->name;
        $logService->scriviLog(auth()->id(), $tipo, $data);

        $this->redirectRoute('lista-operatori', navigate: true);
    }

    public function render()
    {
        return view('livewire.user.modifica-user')
            ->title('modifica user: '. $this->user->name);
    }
}
