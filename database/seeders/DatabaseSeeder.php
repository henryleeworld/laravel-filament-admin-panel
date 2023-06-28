<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            AdminUserSeeder::class,
            ProductSeeder::class,
            VoucherSeeder::class,
            UserSeeder::class,
            PaymentSeeder::class,
            CategorySeeder::class,
            TagsSeeder::class,
        ]);
    }
}
