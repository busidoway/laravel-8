<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        Role::create([
            'level' => 1,
            'role' => 'admin',
        ],
        [
            'level' => 2,
            'role' => 'moderator',
        ],
        [
            'level' => 3,
            'role' => 'user',
        ]);
    }
}
