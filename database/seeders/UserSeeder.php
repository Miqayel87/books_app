<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'login' => 'admin',
            'password' => '$2y$10$tSHMCrv1FxyIUwauRAZbxeCacqiM9wHHIZ9EStG4K5iPN320DWjc6',
            'admin' => 1
        ]);

        User::create([
            'login' => 'user',
            'password' => '$2y$10$tSHMCrv1FxyIUwauRAZbxeCacqiM9wHHIZ9EStG4K5iPN320DWjc6',
            'admin' => 0
        ]);
    }
}
