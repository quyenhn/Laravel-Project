<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Cache;
use Redis;
use App\Activity;
class StatsUserActiveOfTheDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'userActive:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Statistics Daily User Active';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {   
       parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Cache::forever('CacheActiveKey-'.\Carbon\Carbon::today()->toDateString(), 
                        Activity::where( \DB::raw('DATE(day)') , \Carbon\Carbon::today()->toDateString() )->count()
        );
          
    }
}
