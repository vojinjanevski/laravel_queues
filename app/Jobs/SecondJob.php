<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class SecondJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var array
     */
    private $data;

    /**
     * Create a new job instance.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Second Job', $this->data);


        for($i = 1; $i < 1000; $i++)
            for($ii = 1; $ii < 1000; $ii++)
                for($iii = 1; $iii < 1000; $iii++);

        $this->data['second_job_result'] = 'Some more iterations here...';

        $thirdJob = new ThirdJob($this->data);
        $thirdJob->onConnection('database');

        Log::info('Second Job dispatching 3 Third Jobs');
        dispatch($thirdJob);
        dispatch($thirdJob);
        dispatch($thirdJob);
    }
}
