<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaksi;

class ExpireTransactions extends Command
{
    protected $signature = 'transactions:expire';
    protected $description = 'Mark expired transactions as failed';

    public function handle()
    {
        $expiredTransactions = Transaksi::where('status', 'pending')
            ->where('exp', '<', now())
            ->update(['status' => 'failed']);

        $this->info("$expiredTransactions transactions expired.");
    }
}
