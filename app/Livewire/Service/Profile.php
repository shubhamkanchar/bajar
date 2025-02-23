<?php

namespace App\Livewire\Service;

use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        return view('livewire.service.profile')->extends('layouts.profile-layout');
    }
}
