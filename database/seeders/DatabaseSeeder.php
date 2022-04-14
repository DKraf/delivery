<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CreateAdminUserSeeder::class,
            CreateCity::class,
            CreateCountry::class,
            CreateDistance::class,
            CreateStatus::class,
            PermissionTableSeeder::class,
        ]);
    }
}
