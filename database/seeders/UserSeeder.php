<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Nuno França',
            'email' => 'teste@gmail.com',
            'password' => '123123123'
        ]);

        User::create([
            'name' => 'GB Mídias',
            'email' => 'paulodofacebok@gmail.com',
            'password' => 'Cavalo10'
        ])
    }
}
