<?php

namespace Database\Seeders;

use App\Http\Controllers\API\EmailRecordController;
use App\Jobs\EmailRecordJob;
use App\Jobs\EmployeeEmailJob;
use App\Models\EmailRecord;
use App\Models\Employee;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        $limit = 200000;
        $inputs = [];
        $emailData = [];

        for ($i = 0; $i < $limit; $i++) {
            $fakeName = $faker->name;
            $fakeEmail = $faker->unique()->safeEmail;
            $fakeProject = $faker->text(30);
            $current_date_time = Carbon::now()->toDateTimeString();
            $inputs[] = [
                'name' => $fakeName,
                'email' => $fakeEmail,
                'project' => $fakeProject,
                'created_at' => $current_date_time,
                'updated_at' => $current_date_time,
            ];
            $emailData[] = [
                'name' => $fakeName,
                'email' => $fakeEmail,
                'subject' => 'Follow Up on ' . $fakeProject,
                'project_issue' => $fakeProject,
            ];
            if ($i % 1000 == 0) {
                Employee::insert($inputs);
                for ($j = 0; $j < count($emailData); $j++) {
                    dispatch(new EmployeeEmailJob($emailData[$j]));
                }
                $emailData = [];
                $inputs = [];
            }
        }
        if (count($inputs) > 0) {
            Employee::insert($inputs);
            for ($j = 0; $j < count($emailData); $j++) {
                dispatch(new EmployeeEmailJob($emailData[$j]));
            }
        }
        dispatch(new EmailRecordJob());
    }
}
