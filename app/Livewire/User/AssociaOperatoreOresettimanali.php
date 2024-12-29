<?php

namespace App\Livewire\User;

use App\Services\LogService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Livewire\Component;

class AssociaOperatoreOresettimanali extends Component
{
    public $user_id;
    public $oresettimanali;

    public function inserisci(UserService $userService, LogService $logService)
    {
        $request = new Request();
        $request->user_id = $this->user_id;
        $request->oresettimanali = $this->oresettimanali;
        $userService->associaOperatoreOresettimanali($request);

        $tipo = 'associa operatore oreSettimanali';
        $data = 'id operatore: '.$this->user_id.'. Ore Settimanali: '. $this->oresettimanali;
        $logService->scriviLog(auth()->id(), $tipo, $data);

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
