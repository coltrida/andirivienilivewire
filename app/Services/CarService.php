<?php

namespace App\Services;

use App\Models\Car;

class CarService
{
    public function listaVetture()
    {
        return Car::orderBy('name')->get();
    }

    public function elimina($id)
    {
        Car::find($id)->delete();
    }

    public function inserisci($nomeVettura)
    {
        Car::insert([
            'name' => $nomeVettura
        ]);
    }
}
