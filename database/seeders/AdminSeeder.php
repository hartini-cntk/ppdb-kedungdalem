<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin PPDB',
            'email' => 'admin@ppdbkedungdalem.test',
            'password' => Hash::make('admin12345'),
            'role' => 'admin',
        ]);
    }
}