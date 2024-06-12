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
        $threeMonthsAgo = Carbon::now()->subMonths(3);
        Payment::where('created_at', '<', $threeMonthsAgo)
            ->where('payment_status', 'Completed')
            ->update(['payment_status' => 'false']);
    }
}
