<?php

namespace App\Jobs;

use App\Mail\ExpensesPostedDaily;
use App\Models\Expenses;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class EmailNotifier implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $yesterday = Carbon::yesterday()->toDateString();
        $users = User::all();

        foreach ($users as $user) {
            $expenses = Expenses::where('user_id', $user->id) 
                            ->whereDate('date', $yesterday)
                            ->get();

        if ($expenses->isNotEmpty()) {
            Mail::to($user->email)->send(new ExpensesPostedDaily($expenses));
            }
        }
    }
}
