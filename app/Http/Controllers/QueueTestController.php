<?php

namespace App\Http\Controllers;

use App\Jobs\FirstJob;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;

use App\Http\Requests;

class QueueTestController extends Controller
{

    public function index(Request $request)
    {
        $job = new FirstJob(Uuid::uuid(), $request->all());
        dispatch($job->onConnection('database'));
    }
}
