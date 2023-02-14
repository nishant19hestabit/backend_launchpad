<?php

namespace App\Jobs;

use App\Models\EmailRecord;
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

    public $employee;

    public function __construct($data)
    {
        $this->employee = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $emp = Employee::where('email', $this->data['email'])->first();
        $emailData = [
            'name' => $this->employee['name'],
            'email' => $this->employee['email'],
            'subject' => 'Follow Up on ' . $this->employee['project'],
            'project_issue' => $this->employee['project'],
        ];
        Mail::send('emails.mail', $emailData, function ($message) use ($emailData) {
            $message->to($emailData['email'])->subject($emailData['subject']);
        });
    }
    public function failed(Exception $exception)
    {
        // Job processing failed...
        Log::info($exception->getMessage());
        $data = [
            'name' => $this->employee['name'],
            'project_issue' => $this->employee['project'],
        ];
        $html = view('emails.failed', compact('data'))->render();
        EmailRecord::create([
            'emp_id' => $this->employee['id'],
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
            'emp_id' => $this->employee['id'],
            'status' => 'success',
            'email_content' => null,
        ]);
    }
}
