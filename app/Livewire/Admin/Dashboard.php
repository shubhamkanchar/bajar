<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Dashboard extends Component
{
    public $tab;

    public function mount() {

    }   

    public function render()
    {
        return view('livewire.admin.dashboard')->extends('layouts.admin');
    }
}
