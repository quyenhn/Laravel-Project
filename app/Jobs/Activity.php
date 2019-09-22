<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\User;
class Activity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user=$user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        User::where('id', $this->user->id)->update(['last_login_at' => \Carbon\Carbon::now()]);
       
       \Log::info('JOB SUCCESS update time active in day for user_id: '.$this->user->id.' at '.\Carbon\Carbon::now());
    }
    public function failed()
    {
    // Called when the job is failing...
        \Log::info('JOB FAILED for user_id: '.$this->user->id);
    }
}
