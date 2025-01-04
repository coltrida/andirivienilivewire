<?php

namespace App\Livewire\Client;

use App\Models\Client;
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
    public $clientDaModificare;
    public $visualizzaListaClient = true;

    public function inserisciOrModifica(ClientService $clientService, LogService $logService)
    {
        $request = new Request();
        $request->name = $this->name;
        $request->voucher = $this->voucher;
        $request->scadenza = $this->scadenza;

        if ($this->visualizzaListaClient){
            $clientService->inserisci($request);

            $tipo = 'inserimento ragazzo';
            $data = 'inserito: '.$this->name;
            $logService->scriviLog(auth()->id(), $tipo, $data);

            $this->dispatch('info', [
                'title' => 'Inserito Cliente',
            ]);
        } else {
            $clientService->modifica($this->clientDaModificare, $request);

            $tipo = 'dati ragazzo modificati';
            $data = 'modificato: '.$this->clientDaModificare->name.' con id: '.$this->clientDaModificare->id;
            $logService->scriviLog(auth()->id(), $tipo, $data);

            $this->visualizzaListaClient = true;

            $this->dispatch('info', [
                'title' => 'Cliente Modificato',
            ]);
        }

        $this->reset('name', 'voucher', 'scadenza');
    }

    public function modifica(Client $clientDaModificare)
    {
        $this->clientDaModificare = $clientDaModificare;
        $this->visualizzaListaClient = false;
        $this->name = $clientDaModificare->name;
        $this->voucher = $clientDaModificare->voucher;
        $this->scadenza = $clientDaModificare->scadenza;
    }

    public function render(ClientService $clientService)
    {
        return view('livewire.client.inserisci-ragazzo', [
            'listaRagazziPaginate' => $clientService->listaRagazziPaginate()
        ])
            ->title('inserisci cliente');
    }
}
