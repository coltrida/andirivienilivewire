<?php

namespace App\Livewire\Activity;

use App\Services\ActivityService;
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

    public function inserisci(ActivityService $activityService)
    {
        $request = new Request();
        $request->name = $this->name;
        $request->tipo = $this->tipo;
        $request->cost = $this->cost;
        $activityService->inserisci($request);
    }

    public function render(ActivityService $activityService)
    {
        return view('livewire.activity.inserisci-attivita', [
            'listaAttivita' => $activityService->listaAttivita()
        ])
            ->title('inserisci attività');
    }
}
