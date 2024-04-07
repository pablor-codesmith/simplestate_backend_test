<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use SimpleState\Models\AccountBank;
use SimpleState\Models\Transaction;
use SimpleState\Services\DebinManager;

class CreateDebinJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Transaction $transaction)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(DebinManager $debinManager): void
    {
        $bank_id = env("DEBINBANKID");
        $account_id = env("DEBINACCOUNT");
        $cbu = env("DEBINCBU");
        $token = $debinManager->createDebin($bank_id,$account_id,$cbu,$this->transaction->amount,$this->transaction->id);
        if($token){
            $this->transaction->debin_id = $token;
            $this->transaction->save();
        }
    }
}
