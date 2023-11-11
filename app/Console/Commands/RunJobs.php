<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Models\Job;
class RunJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $jobs = Job::get();
        
        foreach($jobs as $job){
            $exitCode = Artisan::call('queue:work', [
                '--queue' => 'default', // Specify the queue name if needed
                '--tries' => 3, // Specify the number of times the job can be tried
                '--job' => get_class($job), // Specify the job class
            ]);
    
            if ($exitCode === 0) {
                return response()->json(['message' => 'Job executed successfully']);
            } else {
                return response()->json(['message' => 'Job execution failed']);
            }
        }
        $this->info('MyCommand has run successfully!');

    }
}
