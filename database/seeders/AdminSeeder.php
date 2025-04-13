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
                'phone' => '8208449976',
                'email' => 'superadmin@bajarbhaw.com',
                'role' => 'superadmin',
                'onboard_completed' => 1
            ],
            [
                'name' => 'Admin',
                'phone' => '9158853602',
                'email' => 'admin@bajarbhaw.com',
                'role' => 'admin',
                'onboard_completed' => 1
            ],
            [
                'name' => 'Product Business',
                'phone' => '1234567890',
                'email' => 'product@bajarbhaw.com',
                'role' => 'business',
                'offering' => 'product',
                'onboard_completed' => 0
            ],
            [
                'name' => 'Service Business',
                'phone' => '0123456789',
                'email' => 'service@bajarbhaw.com',
                'role' => 'business',
                'offering' => 'Service',
                'onboard_completed' => 0
            ],
            [
                'name' => 'Individual',
                'phone' => '1023456789',
                'email' => 'individual@bajarbhaw.com',
                'role' => 'individual',
                'onboard_completed' => 0
            ]
        ];
        foreach($admins as $admin){
            $query = User::updateOrCreate($admin,$admin);
        }
    }
}
