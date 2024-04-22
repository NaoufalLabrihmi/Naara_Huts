<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define the permissions array
        $permissions = ["dashboard", "team", "bookarea", "huts", "booking", "hutlist", "setting", "tesimonial", "report", "gallery", "contact", "roles", "users"];

        // Create roles and assign permissions
        Role::create([
            'name' => 'SuperAdmin',
            'permissions' => json_encode($permissions),
        ]);
    }
}
