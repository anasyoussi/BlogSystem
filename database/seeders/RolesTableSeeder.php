<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
        ]);
        
        \App\Models\Role::create([
            'name' => 'Author',
            'slug' => 'author',
        ]);
        \App\Models\Role::create([
            'name' => 'User',
            'slug' => 'user',
        ]);
    }
}
