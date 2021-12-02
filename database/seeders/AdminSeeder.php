<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public array $admins = [
        'v.nikolaenko',
        'p.antonov',
        'a.grebennikov',
        'a.saprykina'
    ];

    /**
     * Наполняет базу администраторами
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'Администратор',
            'email' => 'admin@devspark.ru',
            'password' => Hash::make('I4jSQm2!ndw6s'),
            'date_birth' => date('Y-m-d'),
            'role_id' => 3,
            'created_at' => date('Y-m-d h:m:s'),
            'updated_at' => date('Y-m-d h:m:s'),
            'email_verified_at' => '' . getdate()['mday'] . '.' . getdate()['mon'] . '.' . getdate()['year'],
        ]);

        foreach ($this->admins as $admin) {
            DB::table('users')->insert([
                'username' => $admin,
                'email' => $admin . '@devspark.ru',
                'password' => Hash::make('12345678'),
                'date_birth' => date('Y-m-d'),
                'role_id' => 3,
                'created_at' => date('Y-m-d h:m:s'),
                'updated_at' => date('Y-m-d h:m:s'),
                'email_verified_at' => '' . getdate()['mday'] . '.' . getdate()['mon'] . '.' . getdate()['year'],
            ]);
        }
    }
}
