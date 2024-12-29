<?php

namespace App\Livewire\Activity;

use App\Services\ActivityService;
use App\Services\ClientService;
use App\Services\LogService;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class AssociaAttivitaRagazzo extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $activity_id;
    public $clients = [];

    public function inserisci(ActivityService $activityService, LogService $logService)
    {
        $request = new Request();
        $request->activity_id = $this->activity_id;
        $request->clients = $this->clients;
        $activityService->inserisciAssociazioneAttivitaClient($request);

        $tipo = 'associa attività ragazzo';
        $data = 'id Attività: '.$this->activity_id.'. lista id ragazzi: '. implode(",",$this->clients);
        $logService->scriviLog(auth()->id(), $tipo, $data);

        $this->reset('activity_id');
        $this->clients = [];
    }

    public function elimina(ActivityService $activityService, LogService $logService, $id)
    {
        $activityService->eliminaAssociazioneAttivitaCliente($id);
        session()->flash('status', 'associazione eliminata');

        $tipo = 'elimina associa attività ragazzo';
        $data = 'id associazione '.$id.' eliminata ';
        $logService->scriviLog(auth()->id(), $tipo, $data);

        $this->redirectRoute('activity-client-associa', navigate: true);
    }

    public function render(ActivityService $activityService, ClientService $clientService)
    {
        return view('livewire.activity.associa-attivita-ragazzo', [
            'listaAttivita' => $activityService->listaAttivita(),
            'listaRagazzi' => $clientService->listaRagazzi(),
            'listaAssociazioniAttivitaClientPaginate' => $clientService->listaAssociazioniAttivitaClientPaginate()
        ])
            ->title('associa attività ragazzo');
    }
}
