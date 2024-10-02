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
        DB::table('roles')->insert([
            ['name' => 'admin', 'guard_name' => 'web'], // menambahkan guard_name
            ['name' => 'developer', 'guard_name' => 'web'], // menambahkan guard_name
            ['name' => 'manajer', 'guard_name' => 'web'], // menambahkan guard_name
            ['name' => 'editor', 'guard_name' => 'web'], // menambahkan guard_name
        ]);

        DB::table('users')->insert([
            [
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'role_id' => '1', //tambahkan role admin
            ],
            [
                'username' => 'developer',
                'email' => 'developer@developer.com',
                'password' => Hash::make('developer'),
                'role_id' => '2', //tambahkan role developer
            ],
            [
                'username' => 'manajer',
                'email' => 'manajer@manajer.com',
                'password' => Hash::make('manajer123'),
                'role_id' => '3', //tambahkan role manajer
            ],
            [
                'username' => 'editor',
                'email' => 'editor@editor.com',
                'password' => Hash::make('editor123'),
                'role_id' => '4', //tambahkan role editor
            ],
        ]);

        DB::table('permissions')->insert([
            ['name' => 'viewDashboard', 'guard_name' => 'web'],
            ['name' => 'viewBoard', 'guard_name' => 'web'],
            ['name' => 'viewTask', 'guard_name' => 'web'],
            ['name' => 'viewOnGoing', 'guard_name' => 'web'],
            ['name' => 'viewProject', 'guard_name' => 'web'],
            ['name' => 'viewManageUser', 'guard_name' => 'web'],
            ['name' => 'addProject', 'guard_name' => 'web'],
            ['name' => 'viewProjectCategories', 'guard_name' => 'web'],
            ['name' => 'viewProjectStatus', 'guard_name' => 'web'],
            ['name' => 'viewTaskPriorities', 'guard_name' => 'web'],
            ['name' => 'viewTaskLabels', 'guard_name' => 'web'],
            ['name' => 'viewRole', 'guard_name' => 'web'],
        ]);

        DB::table('role_has_permissions')->insert([
            ['permission_id' => 1, 'role_id' => 1], // viewDashboard
            ['permission_id' => 2, 'role_id' => 1], // viewBoard
            ['permission_id' => 3, 'role_id' => 1], // viewTask
            ['permission_id' => 4, 'role_id' => 1], // viewOnGoing
            ['permission_id' => 5, 'role_id' => 1], // viewProject
            ['permission_id' => 6, 'role_id' => 1], // viewManageUser
            ['permission_id' => 7, 'role_id' => 1], // addProject
            ['permission_id' => 8, 'role_id' => 1], // viewProjectCategories
            ['permission_id' => 9, 'role_id' => 1], // viewProjectStatus
            ['permission_id' => 10, 'role_id' => 1], // viewTaskPriorities
            ['permission_id' => 11, 'role_id' => 1], // viewTaskLabels
            ['permission_id' => 12, 'role_id' => 1], // viewRole
            ['permission_id' => 13, 'role_id' => 1], // viewRole
        ]);
    }
}
