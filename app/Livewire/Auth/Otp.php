<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Otp extends Component
{
    public function render()
    {
        return view('livewire.auth.otp')->extends('layouts.auth-layout');
    }
}
