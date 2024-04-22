<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //admin
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'role_id' => 1,
                'status' => 'active',
            ],
            //reception
            [
                'name' => 'Reception',
                'email' => 'reception@gmail.com',
                'password' => Hash::make('reception'),
                'role_id' => null,
                'status' => 'active',
            ],
            //user
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user'),
                'role_id' => null,
                'status' => 'active',
            ],
        ]);
    }
}
