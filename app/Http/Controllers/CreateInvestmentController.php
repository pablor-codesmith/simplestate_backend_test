<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvestmentRequest;
use App\Jobs\CreateDebinJob;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use SimpleState\Enums\OperationTypeEnum;
use SimpleState\Enums\TransactionStatusEnum;
use SimpleState\Models\Investment;
use SimpleState\Models\Operation;
use SimpleState\Models\Transaction;

class CreateInvestmentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(InvestmentRequest $request)
    {
        return DB::transaction(function () use ($request){
             $investment = Investment::create($request->validated()+['status' => TransactionStatusEnum::PENDING, 'created_at' => now()->format('Y-m-d')]);
             $operation = Operation::where('name', OperationTypeEnum::INVEST)->firstOrFail()->id;
             $transaction = Transaction::create($request->validated() + ['operation_id' => $operation,'status' => TransactionStatusEnum::PENDING, 'created_at' => now()->format('Y-m-d')]);
             $investment->transaction()->associate($transaction);
             $investment->save();

             CreateDebinJob::dispatchAfterResponse($transaction);

             return response()->json($investment,Response::HTTP_CREATED);
        });

    }
}
