<?php

namespace App\Livewire\Ricevute;

use App\Services\LogService;
use App\Services\RicevuteService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class InserisciRicevuta extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $dataRicevuta;
    public $nominativo;
    public $importo;
    public $modalitaPagamento;
    public $descrizione;
    public $progressivo;
    public $citta;
    public $indirizzo;
    public $cap;
    public $pivaCodfisc;
    public $testo;

    public function inserisci(RicevuteService $ricevuteService, LogService $logService)
    {
        $request = new Request();
        $request->dataRicevuta = $this->dataRicevuta;
        $request->nominativo = $this->nominativo;
        $request->importo = $this->importo;
        $request->modalitaPagamento = $this->modalitaPagamento;
        $request->descrizione = $this->descrizione;
        $request->progressivo = $this->progressivo;
        $request->citta = $this->citta;
        $request->indirizzo = $this->indirizzo;
        $request->cap = $this->cap;
        $request->pivaCodfisc = $this->pivaCodfisc;
        $esito = $ricevuteService->inserisciRicevuta($request);

        $tipo = 'inserimento ricevuta';
        $data = $esito[0];
        $logService->scriviLog(auth()->id(), $tipo, $data);

        if ($esito[1]){
            $this->reset();
            $this->dispatch('info', [
                'title' => $esito[0],
            ]);
            $ricevuta = $esito[1];
            $pdf = Pdf::loadView('livewire.pdf.ricevuta', compact('ricevuta'));
            return response()->streamDownload(function () use($pdf) {
                echo  $pdf->stream();
            }, $ricevuta->progressivo."-".$ricevuta->anno."-".$ricevuta->destinatario.".pdf");
        }

        $this->dispatch('info', [
            'title' => $esito[0],
        ]);
    }

    public function elimina(RicevuteService $ricevuteService, LogService $logService, $id)
    {
        $ricevuteService->eliminaRicevuta($id);

        $tipo = "eliminazione ricevuta";
        $data = "ricevuta con id = $id eliminata";
        $logService->scriviLog(auth()->id(), $tipo, $data);

        $this->dispatch('info', [
            'title' => "Ricevuta con id = $id eliminata",
        ]);
    }

    public function stampa(RicevuteService $ricevuteService, $id)
    {
        $ricevuta = $ricevuteService->ricevutaById($id);
        $pdf = Pdf::loadView('livewire.pdf.ricevuta', compact('ricevuta'));
        return response()->streamDownload(function () use($pdf) {
            echo  $pdf->stream();
        }, $ricevuta->progressivo."-".$ricevuta->anno."-".$ricevuta->destinatario.".pdf");
    }


    /*public function updatedTesto()
    {
        if (strlen($this->testo) >= 2) {
            $this->performSearch();
        }
    }

    public function performSearch()
    {
        dd('ciao');
    }*/

    public function render(RicevuteService $ricevuteService)
    {
        return view('livewire.ricevute.inserisci-ricevuta', [
            'listaRicevutePaginate' => $ricevuteService->listaRicevutePaginate($this->testo)
        ])
            ->title('inserisci ricevuta');
    }
}
