<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'username' => 'developer',
                'email' => 'developer@developer.com',
                'password' => Hash::make('developer'),
                'role' => 'developer',
            ],
            [
                'username' => 'manajer',
                'email' => 'manajer@manajer.com',
                'password' => Hash::make('manajer123'),
                'role' => 'manajer',
            ],
            [
                'username' => 'editor',
                'email' => 'editor@editor.com',
                'password' => Hash::make('editor123'),
                'role' => 'editor',
            ],
        ]);
    }
}
