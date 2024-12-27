<?php

namespace App\Services;

use App\Models\Client;


class ClientService
{
    public function listaRagazzi()
    {
        return Client::orderBy('name')->paginate(5);
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
}
