<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function listaOperatori()
    {
        return User::where('role', '<>', 1)->orderBy('name')->get();
    }

    public function eliminaUser($idUser)
    {
        User::find($idUser)->delete();
    }

    public function modificaUser($user, $nuovaEmail, $nuoveOre)
    {
        $user->email = $nuovaEmail;
        $user->oresettimanali = $nuoveOre;
        $user->save();
    }
}
