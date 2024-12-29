<?php

namespace App\Livewire\Log;

use App\Services\LogService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListaLog extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function render(LogService $logService)
    {
        return view('livewire.log.lista-log', [
            'listaLogPaginate' => $logService->listaLogPaginate()
        ])
            ->title('lista log');
    }
}
