<?php

namespace App\Livewire\Activity;

use App\Services\ActivityService;
use App\Services\LogService;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class InserisciAttivita extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $name;
    public $tipo;
    public $cost;

    public function inserisci(ActivityService $activityService, LogService $logService)
    {
        $request = new Request();
        $request->name = $this->name;
        $request->tipo = $this->tipo;
        $request->cost = $this->cost;
        $activityService->inserisci($request);

        $tipo = 'inserimento attività';
        $data = 'Attività: '.$this->name.' inserita';
        $logService->scriviLog(auth()->id(), $tipo, $data);

        $this->reset('name', 'tipo', 'cost');
    }

    public function render(ActivityService $activityService)
    {
        return view('livewire.activity.inserisci-attivita', [
            'listaAttivitaPaginate' => $activityService->listaAttivitaPaginate()
        ])
            ->title('inserisci attività');
    }
}
