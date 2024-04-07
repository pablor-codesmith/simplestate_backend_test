<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvestmentFilterRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use SimpleState\Models\Investment;

class SearchInvestmentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(InvestmentFilterRequest $request)
    {
        $status = $request->input('status') ?? null;
        $investment = Investment::userInvestments()->when($status, function (Builder $query, string $status) {
            $query->where('investments.status', $status);
        })->paginate();

        return response()->json($investment);
    }
}
