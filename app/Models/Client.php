<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }
}
