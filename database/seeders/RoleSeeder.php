<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Programer',
            'Officer',
            'Designer',
            'Social Media Specialist',
            'Writer',
            'Translator',
            'Admin',
        ];

        foreach ($data as $item ) {
            Role::create([
                'name' => $item
            ]);
        }
    }
}
