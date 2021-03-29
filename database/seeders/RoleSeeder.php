<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Administrator', 'name_abbreviation' => 'Admin'],
            ['id' => 2, 'name' => 'Transport Officer', 'name_abbreviation' => 'TO'],
            ['id' => 3, 'name' => 'Procurement Unit', 'name_abbreviation' => 'PMU',],
            ['id' => 4, 'name' => 'Manager', 'name_abbreviation' => 'MA',],
            ['id' => 5, 'name' => 'PMU DE', 'name_abbreviation' => 'PDE',],

        ];

        foreach ($items as $item) {
            Role::create($item);
        }
    }
}
