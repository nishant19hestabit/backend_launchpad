<?php

namespace App\Console\Commands;

use App\Http\Controllers\RandomController;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DailyQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // public $data;

    // public function __construct(CommandController $data)
    // {
    //     $this->data = $data;
    //     // dd($this->data->randomQuote());
    // }
    protected $signature = 'daily-quote';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = null;
        try {
            $data = new RandomController();
            $results = $data->index();
            if (count($results) > 0) {
                /*  all quotes */

                $response = response()->json($results) . ".\n";

                /* random quote */

                // $response = $this->singleQuote($results);
                
            } else {
                $response = "No data found" . ".\n";
            }
            Log::info($response);
        } catch (Exception $e) {
            $response = $e->getMessage() . ".\n";
            Log::error($response);
        }
        echo $response;
    }
    public function singleQuote($results)
    {
        $limit = count($results) - 1;
        $value = rand(0, $limit);
        $quote = $results[$value]->text . ' --(' . $results[$value]->author . ')';
        return $quote . ".\n";
    }
}
