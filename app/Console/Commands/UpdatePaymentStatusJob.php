<?php

namespace App\Console\Commands;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdatePaymentStatusJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:update_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description update payment';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $oneMonthAgo = Carbon::now()->subMonth();
        $twoWeekAgo = Carbon::now()->subWeek(2);

        Payment::where(function ($query) use ($oneMonthAgo, $twoWeekAgo) {
            $query->where('service_id', 2)
                ->where('created_at', '<', $oneMonthAgo);
        })
            ->orWhere(function ($query) use ($twoWeekAgo) {
                $query->where('service_id', 1)
                    ->where('created_at', '<', $twoWeekAgo);
            })
            ->where('payment_status', 'Success')
            ->update(['payment_status' => 'Completed']);
    }
}
