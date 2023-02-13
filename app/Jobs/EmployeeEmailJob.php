<?php

namespace App\Jobs;

use App\Models\EmailRecord;
use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmployeeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $data;
    public $employee;

    public function __construct($data)
    {
        $this->data = $data;
        $this->employee = Employee::where('email', $this->data['email'])->first();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $emp = Employee::where('email', $this->data['email'])->first();
        Mail::send('emails.mail', $this->data, function ($message) {
            $message->to($this->data['email'])->subject($this->data['subject']);
        });
    }
    public function failed(Exception $exception)
    {
        // Job processing failed...
        Log::info($exception->getMessage());
        $data = [
            'name' => $this->data['name'],
            'project_issue' => $this->data['project_issue'],
        ];
        $html = view('emails.failed', compact('data'))->render();
        EmailRecord::create([
            'emp_id' => $this->employee->id,
            'status' => 'failed',
            'email_content' => $html,
        ]);
    }

    /**
     * Execute after the job has been processed.
     *
     * @return void
     */
    public function after()
    {
        // Perform actions after the job has been processed...
        Log::info('Mail sent!');
        EmailRecord::create([
            'emp_id' => $this->employee->id,
            'status' => 'success',
            'email_content' => null,
        ]);
    }
}
