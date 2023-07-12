<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'super_admin@testorder.com',
            'password' => Hash::make('compose123')
        ]);

        $manager = User::create([
            'name' => 'General Manager',
            'email' => 'manager@testorder.com',
            'password' => Hash::make('12345678')
        ]);

        $chef = User::create([
            'name' => 'Sui Chef',
            'email' => 'chefs@testorder.com',
            'password' => Hash::make('12345678')
        ]);

        $staff = User::create([
            'name' => 'Staff Attendant',
            'email' => 'staffs@testorder.com',
            'password' => '12345678'
        ]);

        $delivery = User::create([
            'name' => 'Delivery Agent',
            'email' => 'delivery@testorder.com',
            'password' => '12345678'
        ]);

        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@testorder.com',
            'password' => '12345678'
        ]);
    }
}
