<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'User',
                'email' => 'user@email.com',
                'cpf' => '109.915.070-10',
                'password' => bcrypt('q1w2e3r4'),
                'birth_date' => '2000-01-01',
                'contract_terms' => true,

                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
