<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Services\UserService;
use Livewire\Component;

class ModificaUser extends Component
{
    public $email;
    public $oresettimanali;
    public $user;

    public function mount(User $user)
    {
        $this->email = $user->email;
        $this->oresettimanali = $user->oresettimanali;
        $this->user = $user;
    }

    public function modifica(UserService $userService)
    {
        $userService->modificaUser($this->user, $this->email, $this->oresettimanali);
        session()->flash('status', 'Utente modificato');
        $this->redirectRoute('lista-operatori', navigate: true);
    }

    public function render()
    {
        return view('livewire.user.modifica-user')
            ->title('modifica user');
    }
}
