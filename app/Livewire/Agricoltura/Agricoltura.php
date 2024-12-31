<?php

namespace App\Livewire\Agricoltura;

use App\Services\ClientService;
use Livewire\Component;

class Agricoltura extends Component
{
    public $prova = 'ciao';
    public $visualizzaModale = false;
    public $client_id;

    public function azioneProva($testo)
    {
       // dd('ciao '.$testo);
    }

    /*public function visModale()
    {
        $this->visualizzaModale = true;
    }

    public function nasModale()
    {
        $this->visualizzaModale = false;
    }*/

    public function inserisci()
    {

    }

    public function visualizza()
    {

    }

    public function stampa()
    {

    }

    public function selezionaPresenzaAssenza($valore)
    {
        dd($valore);
    }

    public function render(ClientService $clientService)
    {
        return view('livewire.agricoltura.agricoltura', [
            'listaRagazzi' => $clientService->listaRagazzi()
        ])
            ->title('Agricoltura');
    }
}
