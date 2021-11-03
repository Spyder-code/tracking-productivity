<?php

namespace Database\Seeders;

use App\Models\ApplicationType;
use Illuminate\Database\Seeder;

class ApplicationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApplicationType::create([
            'name' => 'Productive',
        ]);
        ApplicationType::create([
            'name' => 'Unproductive',
        ]);
        ApplicationType::create([
            'name' => 'Unregistered',
        ]);
        ApplicationType::create([
            'name' => 'Relatif',
        ]);
    }
}
