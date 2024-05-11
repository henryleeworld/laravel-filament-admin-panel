<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        Role::create(['name' => 'User']);
        Role::create(['name' => 'Administrator']);
    }
}
