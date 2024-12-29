<?php

namespace App\Services;


use App\Models\Client;

class StatisticheService
{
    public function presenzeRagazzi($request)
    {
        return Client::with([
            'activitiesMensili' => function($m) use ($request) {
            $m->where('mese', $request->meseSelezionato);
        }, 'activitiesOrario' => function($o) use ($request){
            $o->where('mese', $request->meseSelezionato);
        }])->find($request->client_id);
    }
}
