<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        User::create([
            'name'     => __('Administrator'),
            'email'    => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role_id'  => 2,
        ]);

        User::create([
            'name'     => __('User'),
            'email'    => 'user@admin.com',
            'password' => Hash::make('password'),
            'role_id'  => 1,
        ]);
    }
}
