<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        $teacherRole = Role::create(['name' => 'teacher']);
        $teacherRole->givePermissionTo('COURSE-VIEW');
        $teacherRole->givePermissionTo('COURSE-EDIT');
        $teacherRole->givePermissionTo('ATTENDANCE-VIEW');
        $teacherRole->givePermissionTo('ATTENDANCE-EDIT');
        $teacherRole->givePermissionTo('NOTIFICATION-VIEW');
        $teacherRole->givePermissionTo('NOTIFICATION-EDIT');
        $teacherRole->givePermissionTo('USER-VIEW');

        $studentRole = Role::create(['name' => 'student']);
        $studentRole->givePermissionTo('COURSE-VIEW');
        $studentRole->givePermissionTo('ATTENDANCE-VIEW');
        $studentRole->givePermissionTo('NOTIFICATION-VIEW');
    }
}
