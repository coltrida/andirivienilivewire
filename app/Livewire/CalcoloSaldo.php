<?php

namespace App\Livewire;

use App\Models\Primanota;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class CalcoloSaldo extends Component
{

    public function mount()
    {
        $oggi = Carbon::now();
        $annoOggi = $oggi->year;
        $settimanaAttuale = $oggi->weekOfYear;
        $operatori = User::with(['presenze' => function($p) use($annoOggi){
            $p->where('anno', $annoOggi);
        }])->get();
        foreach ($operatori as $operatore)
        {
            if($operatore->oresettimanali)
            {
                $totaleOreAttese = $settimanaAttuale * $operatore->oresettimanali;
                $totaleOreLavorate = 0;
                foreach ($operatore->presenze as $presenza)
                {
                    $totaleOreLavorate += $presenza->ore;
                }

                //--------- se l'operatore è Matteo Butini gli devo togliere 20 ore di gennaio  --------
                $operatore->oresaldo = $totaleOreAttese - $totaleOreLavorate;
                if ($operatore->name == "Matteo Butini"){
                    $operatore->oresaldo -= 20;
                }
                // --------------------------------------------------------------------------------------

                $operatore->save();
            }
        }

        $this->calcoloSaldoMensilePrimaNota();

    }

    public function calcoloSaldoMensilePrimaNota()
    {
        $primoGiornoDelMese = Carbon::now()->firstOfMonth();
        $orarioAttuale = Carbon::now()->hour;
        $minutiAttuali = Carbon::now()->minute;
        $orario = 02;
        $minuti = 30;

        $oggi = Carbon::now();
        echo 'Il primo del mese è: '.$primoGiornoDelMese->format('Y-m-d').' <br>';
        echo 'oggi è: '.$oggi->format('Y-m-d').' <br>';
        echo 'orario di calcolo saldo : '.$orario.' <br>';
        echo 'orario attuale : '.$orarioAttuale.' <br>';
        echo 'minuti attuali : '.$minutiAttuali;
        if (
            ($oggi->format('Y-m-d') === $primoGiornoDelMese->format('Y-m-d')) &&
            ($orario === $orarioAttuale) && ($minutiAttuali < $minuti)
        ){
            $totEntrateMese = Primanota::where([
                ['anno', $oggi->year],
                ['mese', $oggi->month-1],
                ['tipo', 'entrata'],
            ])->sum('importo');

            $totUsciteMese = Primanota::where([
                ['anno', $oggi->year],
                ['mese', $oggi->month-1],
                ['tipo', 'uscita'],
            ])->sum('importo');
            $saldo = $totEntrateMese - $totUsciteMese;

            Primanota::create([
                'importo' => $saldo < 0 ? -$saldo : $saldo,
                'causale' => 'Saldo mese precedente',
                'anno' => $oggi->year,
                'mese' => $oggi->month,
                'tipo' => $saldo < 0 ? 'uscita' : 'entrata',
            ]);
        }
    }

    public function render()
    {
        return <<<'HTML'
        <div>
            {{-- The Master doesn't talk, he acts. --}}
        </div>
        HTML;
    }
}
