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
        Employee::query()->delete();
        $faker = Factory::create();
        $no_of_rows = 2000000;
        $inputs = [];
        $password = Hash::make(12345678);
        for ($i = 0; $i < $no_of_rows; $i++) {
            $inputs[] = array(
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'project' => $faker->text(30),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            );
            if ($i % 2500 == 0) {
                Employee::insert($inputs);
                $inputs = [];
            }
        }
        if (count($inputs) > 0) {
            Employee::insert($inputs);
        }
        $totalEmployees = Employee::count();
        for ($i = 0; $i < $totalEmployees; $i++) {
            $emp = Employee::find($i + 1);
            dispatch(new EmployeeEmailJob($emp));
        }
        dispatch(new EmailRecordJob());
    }
}
