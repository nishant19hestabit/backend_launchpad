<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Factory::create();
        // $limit = 20000;
        // $pass = Hash::make(12345678);
        // $inputs = [];
        // for ($i = 0; $i < $limit; $i++) {
        //     $fakeName = $faker->name;
        //     $inputs[] = [
        //         'name' => $fakeName,
        //         'email' => $faker->unique()->safeEmail,
        //         'password' => $pass,
        //     ];

        //     if ($i % 10000 == 0) {
        //         User::insert($inputs);
        //         $inputs = [];
        //     }
        // }
        // User::insert($inputs);
    }
}
