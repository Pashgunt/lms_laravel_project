<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public array $roles = [
        'User',
        'Manager',
        'Admin',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach ($this->roles as $role) {
            DB::table('roles')->insert([
                'role_name' => $role,
            ]);
        }
    }
}
