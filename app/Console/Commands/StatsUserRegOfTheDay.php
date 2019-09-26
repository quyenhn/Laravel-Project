<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Cache;
use App\User;
class StatsUserRegOfTheDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'userReg:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Statistics Daily User Register';

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
          Cache::forever('CacheKey-'. \Carbon\Carbon::yesterday()->toDateString(), User::where(\DB::raw('DATE(created_at)'),\Carbon\Carbon::yesterday()->toDateString())->orderBy('created_at','desc')->get()->groupBy(function($item){
                return $item->created_at->format('Y-m-d');
                })
            );
    }
}
