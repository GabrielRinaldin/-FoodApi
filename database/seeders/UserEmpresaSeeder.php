<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //$arrayUserType = ['comum', 'admn', 'empresa'];

        for ($i = 0; $i < 5; $i++) {

            User::create([
                'nome'          => $faker->name,
                'email'         => $faker->email,
                'tipo_usuario'  => 'empresa',
                'celular'         => mt_rand(00000000000, 99999999999),
                'password'      => Hash::make('123456789'),
               'remember_token' => Str::random(10),

            ]);
        }
    }
}
