<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            ['id' => 1, 'name' => 'viewDashboard', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'viewBoard', 'guard_name' => 'web'],
            ['id' => 3, 'name' => 'viewTask', 'guard_name' => 'web'],
            ['id' => 4, 'name' => 'viewOnGoing', 'guard_name' => 'web'],
            ['id' => 5, 'name' => 'viewProject', 'guard_name' => 'web'],
            ['id' => 6, 'name' => 'viewManageUser', 'guard_name' => 'web'],
            ['id' => 7, 'name' => 'addProject', 'guard_name' => 'web'],
            ['id' => 8, 'name' => 'viewProjectCategories', 'guard_name' => 'web'],
            ['id' => 9, 'name' => 'viewProjectStatus', 'guard_name' => 'web'],
            ['id' => 10, 'name' => 'viewTaskPriorities', 'guard_name' => 'web'],
            ['id' => 11, 'name' => 'viewTaskLabels', 'guard_name' => 'web'],
            ['id' => 12, 'name' => 'viewRole', 'guard_name' => 'web'],
            ['id' => 13, 'name' => 'editProjectCategories', 'guard_name' => 'web',],
            ['id' => 14, 'name' => 'deleteProjectCategories', 'guard_name' => 'web',],
            ['id' => 15, 'name' => 'duplicateProject', 'guard_name' => 'web'],
            ['id' => 16, 'name' => 'showProject', 'guard_name' => 'web',],
            ['id' => 17, 'name' => 'editProject', 'guard_name' => 'web',],
            ['id' => 18, 'name' => 'deleteProject', 'guard_name' => 'web',],
            ['id' => 19, 'name' => 'addTaskLabels', 'guard_name' => 'web',],
            ['id' => 20, 'name' => 'editTaskLabels', 'guard_name' => 'web'],
            ['id' => 21, 'name' => 'deleteTaskLabels', 'guard_name' => 'web'],
            ['id' => 22, 'name' => 'editTaskStatus', 'guard_name' => 'web'],
            ['id' => 23, 'name' => 'deleteTaskStatus', 'guard_name' => 'web'],
            ['id' => 24, 'name' => 'addTask', 'guard_name' => 'web'],
            ['id' => 25, 'name' => 'editTask', 'guard_name' => 'web'],
            ['id' => 26, 'name' => 'showTask', 'guard_name' => 'web'],

            [
                'id' => 27,
                'name' => 'deleteTask',
                'guard_name' => 'web',
            ],
            [
                'id' => 28,
                'name' => 'duplicateTask',
                'guard_name' => 'web',
            ],
            [
                'id' => 29,
                'name' => 'viewTaskStatus',
                'guard_name' => 'web',
            ],
            [
                'id' => 30,
                'name' => 'addTaskStatus',
                'guard_name' => 'web',
            ],
            [
                'id' => 31,
                'name' => 'addTaskPriorities',
                'guard_name' => 'web',
            ],
            [
                'id' => 32,
                'name' => 'editTaskPriorities',
                'guard_name' => 'web',
            ],
            [
                'id' => 33,
                'name' => 'deleteTaskPriorities',
                'guard_name' => 'web',
            ],
            [
                'id' => 34,
                'name' => 'addBoard',
                'guard_name' => 'web',
            ],
            [
                'id' => 35,
                'name' => 'showTaskInBoard',
                'guard_name' => 'web',
            ],
            [
                'id' => 36,
                'name' => 'editTaskInBoard',
                'guard_name' => 'web',
            ],
            [
                'id' => 37,
                'name' => 'deleteBoard',
                'guard_name' => 'web',
            ],
            [
                'id' => 38,
                'name' => 'startTask',
                'guard_name' => 'web',
            ],
            [
                'id' => 39,
                'name' => 'pauseTask',
                'guard_name' => 'web',
            ],
            [
                'id' => 40,
                'name' => 'stopTask',
                'guard_name' => 'web',
            ],
            [
                'id' => 41,
                'name' => 'showTaskInDashboard',
                'guard_name' => 'web',
            ],
            [
                'id' => 42,
                'name' => 'viewAllTask',
                'guard_name' => 'web',
            ],
            [
                'id' => 43,
                'name' => 'viewTaskPerUser',
                'guard_name' => 'web',
            ],
            [
                'id' => 44,
                'name' => 'viewPermission',
                'guard_name' => 'web',
            ],
        ]);

        DB::table('role_has_permissions')->insert([
            ['permission_id' => 1, 'role_id' => 1],
            ['permission_id' => 2, 'role_id' => 1],
            ['permission_id' => 3, 'role_id' => 1],
            ['permission_id' => 4, 'role_id' => 1],
            ['permission_id' => 5, 'role_id' => 1],
            ['permission_id' => 6, 'role_id' => 1],
            ['permission_id' => 7, 'role_id' => 1],
            ['permission_id' => 8, 'role_id' => 1],
            ['permission_id' => 9, 'role_id' => 1],
            ['permission_id' => 10, 'role_id' => 1],
            ['permission_id' => 11, 'role_id' => 1],
            ['permission_id' => 12, 'role_id' => 1],
            ['permission_id' => 13, 'role_id' => 1],
            ['permission_id' => 14, 'role_id' => 1],
            ['permission_id' => 15, 'role_id' => 1],
            ['permission_id' => 16, 'role_id' => 1],
            ['permission_id' => 17, 'role_id' => 1],
            ['permission_id' => 18, 'role_id' => 1],
            ['permission_id' => 19, 'role_id' => 1],
            ['permission_id' => 20, 'role_id' => 1],
            ['permission_id' => 21, 'role_id' => 1],
            ['permission_id' => 22, 'role_id' => 1],
            ['permission_id' => 23, 'role_id' => 1],
            ['permission_id' => 24, 'role_id' => 1],
            ['permission_id' => 25, 'role_id' => 1],
            ['permission_id' => 26, 'role_id' => 1],
            ['permission_id' => 27, 'role_id' => 1],
            ['permission_id' => 28, 'role_id' => 1],
            ['permission_id' => 29, 'role_id' => 1],
            ['permission_id' => 30, 'role_id' => 1],
            ['permission_id' => 31, 'role_id' => 1],
            ['permission_id' => 32, 'role_id' => 1],
            ['permission_id' => 33, 'role_id' => 1],
            ['permission_id' => 34, 'role_id' => 1],
            ['permission_id' => 35, 'role_id' => 1],
            ['permission_id' => 36, 'role_id' => 1],
            ['permission_id' => 37, 'role_id' => 1],
            ['permission_id' => 38, 'role_id' => 1],
            ['permission_id' => 39, 'role_id' => 1],
            ['permission_id' => 40, 'role_id' => 1],
            ['permission_id' => 41, 'role_id' => 1],
            ['permission_id' => 42, 'role_id' => 1],
            ['permission_id' => 43, 'role_id' => 1],
            ['permission_id' => 44, 'role_id' => 1],
        ]);
    }
}
