<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use SimpleState\Enums\DebinStatusEnum;
use SimpleState\Enums\TransactionStatusEnum;
use SimpleState\Models\Transaction;
use SimpleState\Services\DebinManager;

class UpdateDebinStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $bank_id = env("DEBINBANKID");

    protected $account_id = env("DEBINACCOUNT");

    protected $cbu = env("DEBINCBU");

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
    public function handle(DebinManager $debinManager): void
    {
        Transaction::where('status',TransactionStatusEnum::PENDING)->chunk(100,function(Collection $transactions) use ($debinManager){
            $transactions->each(function($transaction) use ($debinManager){
                $response = $debinManager->takeDebinStatus($this->bank_id,$this->account_id,$transaction->debin_id);
                switch ($response) {
                    case DebinStatusEnum::COMPLETED:
                        $transaction->status = TransactionStatusEnum::APPROVED;
                        break;
                    case DebinStatusEnum::AWAITING_CONFIRMATION:
                    case DebinStatusEnum::IN_PROGRESS:
                        $transaction->status = TransactionStatusEnum::PENDING;
                        break;
                    default:
                        $transaction->status = TransactionStatusEnum::REJECTED;
                        break;
                }

                $transaction->save();
            });
        });
    }
}
