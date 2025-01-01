<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'activities_clients');
    }

    public function activitiesMensili()
    {
        return $this->belongsToMany(Activity::class, 'activities_clients')
            ->where('tipo', 'mensile')->withPivot('quantita', 'costo', 'mese', 'anno', 'giorno', 'id');
    }

    public function activitiesOrario()
    {
        return $this->belongsToMany(Activity::class, 'activities_clients')
            ->where('tipo', 'orario')->withPivot('quantita', 'costo', 'mese', 'anno', 'giorno', 'id');
    }

    public function trips()
    {
        return $this->belongsToMany(Trip::class);
    }

    public function presenzeAgricoltura()
    {
        return $this->hasMany(Agricoltura::class, 'user_id')->where('tipo', 'P');
    }

    public function assenzeAgricoltura()
    {
        return $this->hasMany(Agricoltura::class, 'user_id')->where('tipo', 'A');
    }
}
