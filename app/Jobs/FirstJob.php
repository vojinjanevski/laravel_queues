<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class FirstJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var array
     */
    private $data;
    /**
     * @var string
     */
    private $id;

    /**
     * Create a new job instance.
     * @param string $id
     * @param array $data
     */
    public function __construct(string $id, array $data)
    {
        $this->data = $data;
        $this->id = $id;

        $this->data['uuid'] = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('First Job', $this->data);
        
        for($i = 1; $i < 1000; $i++)
            for($ii = 1; $ii < 1000; $ii++)
                for($iii = 1; $iii < 1000; $iii++);
        
        $this->data['first_job_result'] = 'Hell lot of iterations!';
        
        Log::info('First Job starting 2 Second Jobs');
        $secondJob = new SecondJob($this->data);
        $secondJob->onConnection('database');
        dispatch($secondJob);
        dispatch($secondJob);
    }
}
