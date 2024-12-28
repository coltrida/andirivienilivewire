<?php

namespace App\Livewire\User;

use App\Services\PresenzaService;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PresenzeOperatori extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $giorno;
    public $ore;

    public function inserisci(PresenzaService $presenzaService)
    {
        $request = new Request();
        $request->giorno = $this->giorno;
        $request->ore = $this->ore;
        $presenzaService->inserisciPresenza($request);

        $this->reset('giorno');
        $this->reset('ore');
    }

    public function eliminaPresenza(PresenzaService $presenzaService, $idPresenza)
    {
        $presenzaService->eliminaPresenza($idPresenza);
    }

    public function render(PresenzaService $presenzaService)
    {
        return view('livewire.user.presenze-operatori', [
            'listaPresenze' => $presenzaService->listaPresenze(auth()->id())
        ])
            ->title('presenze operatori');
    }
}
