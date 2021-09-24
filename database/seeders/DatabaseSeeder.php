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
        //permission seeder
        $this->call(PermissionTableSeeder::class);

        // role seeder
        $this->call(RoleTableSeeder::class);
    }
}
