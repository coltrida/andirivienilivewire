<?php

namespace App\Livewire\Client;

use App\Services\ActivityService;
use App\Services\ClientService;
use App\Services\LogService;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PresenzeAttivita extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $activity_id;
    public $clients = [];
    public $giorno;
    public $quantita;
    public $note;

    public function attivitaSelezionata(ActivityService $activityService)
    {
        $this->clients = $activityService->listaIdClientsFromIdActivity($this->activity_id);
    }

    public function inserisci(ActivityService $activityService, LogService $logService)
    {
        $request = new Request();
        $request->activity_id = $this->activity_id;
        $request->clients = $this->clients;
        $request->giorno = $this->giorno;
        $request->quantita = $this->quantita;
        $request->note = $this->note;
        $activityService->inserisciAttivitaClient($request);

        $tipo = 'inserimento presenze attività';
        $data = 'id Attività: '.$this->activity_id.'. lista id ragazzi: '. implode(",",$this->clients);
        $logService->scriviLog(auth()->id(), $tipo, $data);

        $this->reset('activity_id', 'giorno', 'quantita', 'note');
        $this->clients = [];
    }

    public function elimina(ActivityService $activityService, LogService $logService, $id)
    {
        $activityService->eliminaAttivitaClient($id);

        $tipo = 'eliminazione presenze attività';
        $data = 'id Presenza - Attività: '.$id.' eliminata';
        $logService->scriviLog(auth()->id(), $tipo, $data);
    }

    public function render(ClientService $clientService, ActivityService $activityService)
    {
        return view('livewire.client.presenze-attivita', [
            'listaAttivitaClientPaginate' => $clientService->listaAttivitaClientPaginate(),
            'listaAttivita' => $activityService->listaAttivita(),
            'listaRagazzi' => $clientService->listaRagazzi()
        ])
            ->title('presenze attività');
    }
}
