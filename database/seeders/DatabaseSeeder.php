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
            // UserSeeder::class,
            // ApplicationTypeSeeder::class,
            // CategorySeeder::class
            RoleSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();
        // \App\Models\Task::factory(5)->create();
    }
}
