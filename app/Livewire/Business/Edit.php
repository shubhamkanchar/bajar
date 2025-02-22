<?php

namespace App\Livewire\Business;

use Livewire\Component;

class Edit extends Component
{
    public function render()
    {
        return view('livewire.business.edit')->extends('layouts.profile-layout');
    }
}
