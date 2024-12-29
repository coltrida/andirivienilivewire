<?php

namespace App\Livewire\User;

use App\Services\UserService;
use Illuminate\Http\Request;
use Livewire\Component;

class AssociaOperatoreOresettimanali extends Component
{
    public $user_id;
    public $oresettimanali;

    public function inserisci(UserService $userService)
    {
        $request = new Request();
        $request->user_id = $this->user_id;
        $request->oresettimanali = $this->oresettimanali;
        $userService->associaOperatoreOresettimanali($request);

        $this->reset('user_id', 'oresettimanali');
    }

    public function render(UserService $userService)
    {
        return view('livewire.user.associa-operatore-oresettimanali', [
            'listaOperatori' => $userService->listaOperatori()
        ])
            ->title('associa operatore ore');
    }
}
