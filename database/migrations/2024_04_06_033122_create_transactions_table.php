<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use SimpleState\Enums\TransactionStatusEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('wallet')->dropIfExists('transactions');
        Schema::connection('wallet')->create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('amount');
            $table->string('status')->default(TransactionStatusEnum::PENDING);
            $table->bigInteger('user_id')->unsigned();
            $table->foreignId('operation_id')->constrained();
            $table->date('created_at')->useCurrent();
            $table->string('debin_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('wallet')->dropIfExists('transactions');
    }
};
