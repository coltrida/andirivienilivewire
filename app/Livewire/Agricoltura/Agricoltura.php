<?php

namespace App\Livewire\Agricoltura;

use App\Services\AgricolturaService;
use App\Services\ClientService;
use App\Services\LogService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;
use function Laravel\Prompts\alert;

class Agricoltura extends Component
{
    public $prova = 'ciao';
    public $visualizzaModale = false;
    public $visualizzaPresenze = false;
    public $client_id;
    public $presenzeClientSelezionato = [];
    public $assenzeClientSelezionato = [];
    public $listaPresenze = [];
    public $anno;
    public $mese;
    public $valoriSelezionati1;
    public $valoriSelezionati2;
    public $valoriSelezionati3;
    public $valoriSelezionati4;
    public $valoriSelezionati5;
    public $valoriSelezionati6;
    public $valoriSelezionati7;
    public $valoriSelezionati8;
    public $valoriSelezionati9;
    public $valoriSelezionati10;
    public $valoriSelezionati11;
    public $valoriSelezionati12;
    public $valoriSelezionati13;
    public $valoriSelezionati14;
    public $valoriSelezionati15;
    public $valoriSelezionati16;
    public $valoriSelezionati17;
    public $valoriSelezionati18;
    public $valoriSelezionati19;
    public $valoriSelezionati20;
    public $valoriSelezionati21;
    public $valoriSelezionati22;
    public $valoriSelezionati23;
    public $valoriSelezionati24;
    public $valoriSelezionati25;
    public $valoriSelezionati26;
    public $valoriSelezionati27;
    public $valoriSelezionati28;
    public $valoriSelezionati29;
    public $valoriSelezionati30;
    public $valoriSelezionati31;

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

    public function inserisci(AgricolturaService $agricolturaService, LogService $logService)
    {
        $request = new Request();
        $request->client_id = $this->client_id;
        $request->mese = $this->mese;
        $request->anno = $this->anno;
        for ($i=1; $i<=31; $i++){
            $nomeChiave = "valoriSelezionati" . $i;
            $request->$nomeChiave = $this->$nomeChiave;
        }
        $agricolturaService->inserisciPresenze($request);

        for ($i=1; $i<=31; $i++){
            $nomeChiave = "valoriSelezionati" . $i;
            $this->reset("$nomeChiave");
        }

        $tipo = 'inserimento agricoltura';
        $data = 'inserite presenze per idClient: '.$this->client_id.' nel mese di '.$this->mese.' e anno '.$this->anno;
        $logService->scriviLog(auth()->id(), $tipo, $data);

        $this->listaPresenze = $agricolturaService->visualizzaPresenze($request);

        $this->visualizzaPresenze = true;
    }

    public function visualizza(AgricolturaService $agricolturaService)
    {
        $request = new Request();
        $request->client_id = $this->client_id;
        $request->mese = $this->mese;
        $request->anno = $this->anno;
        $this->listaPresenze = $agricolturaService->visualizzaPresenze($request);
        $this->visualizzaPresenze = true;
    }

    public function stampa()
    {

    }

    public function selezionaPresenzaAssenza($valore)
    {
        //dd(Carbon::make($valore[1]));
    }

    public function operatoreSelezionato(AgricolturaService $agricolturaService)
    {
        $request = new Request();
        $request->client_id = $this->client_id;
        $request->mese = $this->mese;
        $request->anno = $this->anno;
        $risultati = $agricolturaService->presenzeAssenze($request);
        $this->presenzeClientSelezionato = $risultati->presenzeAgricoltura->pluck('giornosingolo')->toArray();
        $this->assenzeClientSelezionato = $risultati->assenzeAgricoltura->pluck('giornosingolo')->toArray();
       // dd($this->presenzeClientSelezionato);
    }

    public function elimina(AgricolturaService $agricolturaService, LogService $logService, $id)
    {
        $agricolturaService->eliminaPresenza($id);

        $tipo = 'eliminazione agricoltura';
        $data = 'eliminata presenze con id: '.$id;
        $logService->scriviLog(auth()->id(), $tipo, $data);

        $request = new Request();
        $request->client_id = $this->client_id;
        $request->mese = $this->mese;
        $request->anno = $this->anno;
        $this->listaPresenze = $agricolturaService->visualizzaPresenze($request);
    }

    public function render(ClientService $clientService)
    {
        return view('livewire.agricoltura.agricoltura', [
            'listaRagazzi' => $clientService->listaRagazzi()
        ])
            ->title('Agricoltura');
    }
}