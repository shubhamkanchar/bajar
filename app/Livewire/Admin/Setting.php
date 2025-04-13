<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class Setting extends Component
{
    public $admins = [];

    public function mount(){
        $allAdmin = User::where('role','admin')->get();
        foreach($allAdmin as $admin){
            $this->admins[] = ['name' => $admin->name, 'email' => $admin->email];
        }
    }

    public function addAdmin()
    {
        $this->admins[] = ['name' => '', 'email' => ''];
    }

    public function removeAdmin($index)
    {
        unset($this->admins[$index]);
        $this->admins = array_values($this->admins); // reindex
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.admin.setting');
    }
}
