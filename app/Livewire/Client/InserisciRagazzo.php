<?php

namespace App\Livewire\Client;

use App\Services\ClientService;

use App\Services\LogService;
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

    public function inserisci(ClientService $clientService, LogService $logService)
    {
        $request = new Request();
        $request->name = $this->name;
        $request->voucher = $this->voucher;
        $request->scadenza = $this->scadenza;
        $clientService->inserisci($request);

        $tipo = 'inserimento ragazzo';
        $data = 'inserito: '.$this->name;
        $logService->scriviLog(auth()->id(), $tipo, $data);

        $this->reset('name', 'voucher', 'scadenza');
    }

    public function render(ClientService $clientService)
    {
        return view('livewire.client.inserisci-ragazzo', [
            'listaRagazziPaginate' => $clientService->listaRagazziPaginate()
        ])
            ->title('inserisci ragazzo');
    }
}
