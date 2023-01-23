<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'role_id'   => '1',
            'name'      => 'MD.Admin',
            'username'  => 'admin',
            'email'     => 'admin@app.com',
            'password'  => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password 
        ]);

        \App\Models\User::create([
            'role_id'   => '2',
            'name'      => 'MD.Author',
            'username'  => 'author',
            'email'     => 'author@app.com',
            'password'  => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password 
        ]);
    }
}
