<?php

namespace App\Services;

use App\Models\Activity;

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
}
