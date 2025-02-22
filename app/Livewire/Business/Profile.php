<?php

namespace App\Livewire\Business;

use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        return view('livewire.business.profile')->extends('layouts.profile-layout');
    }
}
