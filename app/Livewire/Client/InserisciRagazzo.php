<?php

namespace App\Livewire\Client;

use App\Services\ClientService;

use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class InserisciRagazzo extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $name;
    public $voucher;
    public $scadenza;

    public function inserisci(ClientService $clientService)
    {
        $request = new Request();
        $request->name = $this->name;
        $request->voucher = $this->voucher;
        $request->scadenza = $this->scadenza;
        $clientService->inserisci($request);
    }

    public function render(ClientService $clientService)
    {
        return view('livewire.client.inserisci-ragazzo', [
            'listaRagazzi' => $clientService->listaRagazzi()
        ])
            ->title('inserisci ragazzo');
    }
}
