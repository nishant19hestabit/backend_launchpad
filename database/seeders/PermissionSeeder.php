<?php

namespace Database\Seeders;

use App\Models\ModuleType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'COURSE-CREATE']);
        Permission::create(['name' => 'COURSE-VIEW']);
        Permission::create(['name' => 'COURSE-EDIT']);
        Permission::create(['name' => 'COURSE-DELETE']);

        Permission::create(['name' => 'ATTENDANCE-CREATE']);
        Permission::create(['name' => 'ATTENDANCE-VIEW']);
        Permission::create(['name' => 'ATTENDANCE-EDIT']);
        Permission::create(['name' => 'ATTENDANCE-DELETE']);

        Permission::create(['name' => 'NOTIFICATION-CREATE']);
        Permission::create(['name' => 'NOTIFICATION-VIEW']);
        Permission::create(['name' => 'NOTIFICATION-EDIT']);
        Permission::create(['name' => 'NOTIFICATION-DELETE']);

        Permission::create(['name' => 'USER-CREATE']);
        Permission::create(['name' => 'USER-VIEW']);
        Permission::create(['name' => 'USER-EDIT']);
        Permission::create(['name' => 'USER-DELETE']);
    }
}
