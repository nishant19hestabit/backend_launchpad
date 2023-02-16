<?php

namespace Database\Seeders;

use App\Jobs\EmailRecordJob;
use App\Jobs\EmployeeEmailJob;
use App\Models\Employee;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use PDF;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Employee::count() == 0) {
            $faker = Factory::create();
            $no_of_rows = 2000000;
            $batch_size = 5000;
            $email = 'email@getnada.com';
            $timestamp = Carbon::now()->toDateTimeString();
            $inputs = [];
            for ($i = 0; $i < $no_of_rows; $i++) {
                $inputs[] = [
                    'name' => $faker->name,
                    'email' => $email,
                    'project' => $faker->text(30),
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ];

                if (($i + 1) % $batch_size === 0) {
                    Employee::insert($inputs);
                    $inputs = [];
                }
            }
            $totalEmployees = Employee::count();
            for ($i = 0; $i < $totalEmployees; $i++) {
                $emp = Employee::find($i + 1);
                dispatch(new EmployeeEmailJob($emp));
            }
            
        }
    }
}
