<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@laundry.com'],
            [
                'name' => 'Admin Laundry',
                'password' => Hash::make('password'),
            ]
        );
    }
}