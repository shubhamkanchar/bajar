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
            $this->admins[] = ['id'=>$admin->id,'name' => $admin->name, 'email' => $admin->email];
        }
    }

    public function addAdmin()
    {
        $this->admins[] = ['id'=>'','name' => '', 'email' => ''];
    }

    public function removeAdmin($index,$id=NULL)
    {
        if($id){
            User::where('id',$id)->delete();
        }
        unset($this->admins[$index]);
        $this->admins = array_values($this->admins); // reindex
    }

    public function saveAdmin()
    {
        foreach($this->admins as $admin){
            if(!empty($admin['name']) && !empty($admin['email'])){
                $user = User::where('email',$admin['email'])->first();
                if(empty($user)){
                    $user = new User();
                }
                $user->name = $admin['name'];
                $user->email = $admin['email'];
                $user->role = 'admin';
                $user->save();
            }
        }
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Admin data Updated Successfully'
        ]);
        
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
