<?php

namespace App\Services;

use App\Models\Ricevuta;
use Carbon\Carbon;

class RicevuteService
{
    public function listaRicevutePaginate()
    {
        return Ricevuta::latest()->paginate(10);
    }

    public function inserisciRicevuta($request)
    {
        $anno = Carbon::make($request->dataRicevuta)->year;

        if ($request->progressivo){
            $progressivo = $request->progressivo;
            $ricevutaGiaPresente = Ricevuta::where([
                ['progressivo', $progressivo],
                ['anno', $anno]
            ])->first();
            if ($ricevutaGiaPresente){
                return 'numero progressivo già presente, ricevuta non inserita';
            }
        } else {
            $ultimaRicevuta = Ricevuta::where('anno', $anno)->orderBy('progressivo', 'DESC')->first();
            $progressivo = $ultimaRicevuta ? $ultimaRicevuta->progressivo + 1 : 1;
        }

        Ricevuta::create([
            'destinatario' => $request->nominativo,
            'indirizzo' => $request->indirizzo,
            'citta' => $request->citta,
            'cap' => $request->cap,
            'pivaCodfisc' => $request->pivaCodfisc,
            'importo' => $request->importo,
            'modalitaPagamento' => $request->modalitaPagamento,
            'descrizione' => $request->descrizione,
            'dataRicevuta' => $request->dataRicevuta,
            'anno' => $anno,
            'progressivo' => $progressivo,
        ]);

        return 'ricevuta inserita';
    }
}