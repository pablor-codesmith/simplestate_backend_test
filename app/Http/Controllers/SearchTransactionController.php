<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionFilterRequest;
use App\Http\Resources\TransactionCollectionResource;
use App\Http\Resources\TransactionResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use SimpleState\Models\Transaction;

class SearchTransactionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(TransactionFilterRequest $request)
    {
        $user_id = $request->validated('user_id');
        $created_at = $request->validated('created_at');
        $operation_id = $request->validated('operation_id');
        $transactions  = Transaction::with(['user','operation'])
            ->when($user_id, function (Builder $query, int $user_id) {
                $query->where('user_id', $user_id);
            })
            ->when($created_at, function (Builder $query, $created_at) {
                $query->whereBetween('created_at', [$created_at,$created_at]);
            })
            ->when($operation_id, function (Builder $query, int $operation_id) {
                $query->where('operation_id', $operation_id);
            })
            ->paginate();

        return new TransactionCollectionResource($transactions);
    }
}
