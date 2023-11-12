<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {


        // User::create($arr);
        User::upsert(

            [
                [
                    'name' => 'htut',
                    'email' => 'htut@gmail.com',
                    'password' => Hash::make('pass1234'),

                    'email_verified_at' => now(),
                    'role' => 'user',

                    'remember_token' => Str::random(10),
                    'created_at' => now(),
                    'updated_at' => now()


                ],
                [
                    'name' => 'saw',
                    'email' => 'saw@gmail.com',
                    'password' => Hash::make('pass1234'),

                    'email_verified_at' => now(),
                    'role' => 'admin',

                    'remember_token' => Str::random(10),
                    'created_at' => now(),
                    'updated_at' => now()


                ]
            ],
            [
                'email',
            ],
            [
                'name',

                'password',

                'email_verified_at',
                'role',

                'remember_token',
                'created_at',
                'updated_at'
            ]

        );
        User::factory(10)->create();
    }
}
