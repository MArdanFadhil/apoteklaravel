<?php

namespace Database\Seeders;

use App\Models\user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'name' => 'Administrator',
        //     'email' => 'apotek_admin@gmail.com',
        //     'password' => Hash::make('adminapotek'),
        //     'role' => 'admin',
        // ]);

        User::create([
            'name' => 'Cashier',
            'email' => 'apotek_cashier@gmail.com',
            'password' => Hash::make('cashierapotek'),
            'role' => 'cashier',
        ]);
        
        User::insert($data);
    }
}
