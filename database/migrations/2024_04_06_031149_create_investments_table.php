<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use SimpleState\Enums\InvestmentStatusEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->integer('amount')->unsigned();
            $table->string('status')->default(InvestmentStatusEnum::PENDING);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('project_id')->constrained();
            $table->bigInteger('transaction_id')->unsigned()->nullable();
            $table->date('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};
