<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Super Admin',
                'phone' => '9923593375',
                'email' => 'superadmin@bajarbhaw.com',
                'role' => 'superadmin',
                'onboard_completed' => 1
            ],
            [
                'name' => 'Admin',
                'phone' => '7588297575',
                'email' => 'admin@bajarbhaw.com',
                'role' => 'superadmin',
                'onboard_completed' => 1
            ]
        ];
        foreach($admins as $admin){
            $query = User::updateOrCreate($admin,$admin);
        }
    }
}
