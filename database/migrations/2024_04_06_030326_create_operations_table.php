<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('wallet')->dropIfExists('transactions');
        Schema::connection('wallet')->dropIfExists('operations');
        Schema::connection('wallet')->create('operations', function (Blueprint $table) {
            $table->id();
            $table->string('name',30);
            $table->string('operator',1)->default('+');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('wallet')->dropIfExists('operations');
    }
};
