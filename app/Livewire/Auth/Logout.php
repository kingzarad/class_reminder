<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Logout extends Component
{
    public function render()
    {
        return view('livewire.auth.logout');
    }

    public function logout()
    {
        auth()->logout();
        $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Logout sucessfully.');
        return $this->redirect('/', navigate: true);
    }
}
