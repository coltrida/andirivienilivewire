<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Associa;

class ActivityService
{
    public function listaAttivita()
    {
        return Activity::orderBy('name')->paginate(5);
    }

    public function inserisci($request)
    {
        Activity::create([
            'name' => $request->name,
            'tipo' => $request->tipo,
            'cost' => $request->cost,
        ]);
    }

    public function inserisciAssociazioneAttivitaClient($request)
    {
        $activity = Activity::find($request->activity_id);
        $activity->associaclients()->attach($request->clients);
    }

    public function eliminaAssociazioneAttivitaCliente($id)
    {
        Associa::find($id)->delete();
    }
}
