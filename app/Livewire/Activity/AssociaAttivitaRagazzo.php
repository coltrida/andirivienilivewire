<?php

namespace App\Livewire\Activity;

use App\Services\ActivityService;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class AssociaAttivitaRagazzo extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $activity_id;
    public $clients = [];

    public function inserisci(ActivityService $activityService)
    {
        $request = new Request();
        $request->activity_id = $this->activity_id;
        $request->clients = $this->clients;
        $activityService->inserisciAssociazioneAttivitaClient($request);

        $this->reset('activity_id');
        $this->clients = [];
    }

    public function elimina(ActivityService $activityService, $id)
    {
        $activityService->eliminaAssociazioneAttivitaCliente($id);
        session()->flash('status', 'associazione eliminata');
        $this->redirectRoute('activity-client-associa', navigate: true);
    }

    public function render(ActivityService $activityService, ClientService $clientService)
    {
        return view('livewire.activity.associa-attivita-ragazzo', [
            'listaAttivita' => $activityService->listaAttivita(),
            'listaRagazzi' => $clientService->listaRagazzi(),
            'listaAssociazioniAttivitaClient' => $clientService->listaAssociazioniAttivitaClient()
        ])
            ->title('associa attività ragazzo');
    }
}
