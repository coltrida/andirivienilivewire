<?php

namespace App\Services;

use App\Models\Associa;
use App\Models\Client;


class ClientService
{
    public function listaRagazziPaginate()
    {
        return Client::orderBy('name')->paginate(5);
    }

    public function listaRagazzi()
    {
        return Client::orderBy('name')->get();
    }

    public function inserisci($request)
    {
        Client::insert([
            'name' => $request->name,
            'voucher' => $request->voucher,
            'scadenza' => $request->scadenza,
        ]);
    }

    public function modifica($client, $request)
    {
        $client->name = $request->name;
        $client->voucher = $request->voucher;
        $client->scadenza = $request->scadenza;
        $client->save();
    }

    public function listaAssociazioniAttivitaClient()
    {
        return Associa::with('client', 'activity')->orderBy('activity_id')->paginate(5);
    }
}
