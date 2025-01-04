<?php

namespace App\Livewire\User;

use App\Services\LogService;
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

    public function inserisci(PresenzaService $presenzaService, LogService $logService)
    {
        $request = new Request();
        $request->giorno = $this->giorno;
        $request->ore = $this->ore;
        $presenzaService->inserisciPresenza($request);

        $tipo = 'inserimento presenze operatore';
        $data = 'inserimento presenza del giorno: '.$this->giorno.' di ore: '. $this->ore;
        $logService->scriviLog(auth()->id(), $tipo, $data);

        $this->reset('giorno', 'ore');

        $this->dispatch('info', [
            'title' => 'Presenza Inserita',
        ]);
    }

    public function eliminaPresenza(PresenzaService $presenzaService, LogService $logService, $idPresenza)
    {
        $presenzaDaInviareALog = $presenzaService->eliminaPresenza($idPresenza);

        $tipo = 'eliminazione presenze operatore';
        $data = 'eliminata presenza del giorno: '.$presenzaDaInviareALog->giorno.' di ore: '. $presenzaDaInviareALog->ore;
        $logService->scriviLog(auth()->id(), $tipo, $data);

        $this->dispatch('info', [
            'title' => 'Presenza eliminata',
        ]);
    }

    public function render(PresenzaService $presenzaService)
    {
        return view('livewire.user.presenze-operatori', [
            'listaPresenzePaginate' => $presenzaService->listaPresenzePaginate(auth()->id())
        ])
            ->title('presenze operatori');
    }
}
