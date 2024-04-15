<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class CustomLogin extends Component
{
    public $username, $password;

    public function render()
    {
        return view('livewire.auth.custom-login');
    }

    public function authLogin()
    {
        $validatedData = $this->validate([
            'username' => 'required|max:50',
            'password' => 'required|min:5|max:50'
        ]);

        if (auth()->attempt($validatedData)) {
            request()->session()->regenerate();
            $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Logged in successfully!');
            return $this->redirect('admin/dashboard', navigate: true);
        }
        $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'No matching user found with the provided username and password.');

    }
}
