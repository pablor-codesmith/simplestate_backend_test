<?php

use App\Http\Controllers\CreateInvestmentController;
use App\Http\Controllers\SearchInvestmentController;
use App\Http\Controllers\SearchTransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('investment', SearchInvestmentController::class)->name('investment.list');
Route::post('investment',CreateInvestmentController::class)->name('investment.create');
Route::get('transaction', SearchTransactionController::class)->name('transaction.list');
