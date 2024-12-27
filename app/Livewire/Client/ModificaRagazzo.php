<?php

namespace App\Livewire\Client;

use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Livewire\Component;

class ModificaRagazzo extends Component
{
    public $client;
    public $name;
    public $voucher;
    public $scadenza;

    public function mount(Client $client)
    {
        $this->client = $client;
        $this->name = $client->name;
        $this->voucher = $client->voucher;
        $this->scadenza = $client->scadenza;
    }

    public function modifica(ClientService $clientService)
    {
        $request = new Request();
        $request->name = $this->name;
        $request->voucher = $this->voucher;
        $request->scadenza = $this->scadenza;
        $clientService->modifica($this->client, $request);

        session()->flash('status', 'ragazzo modificato');
        $this->redirectRoute('client-inserisci', navigate: true);
    }

    public function render()
    {
        return view('livewire.client.modifica-ragazzo')
            ->title('modifica '.$this->client->name);
    }
}
