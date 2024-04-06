<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::connection('wallet')->unprepared(file_get_contents(database_path('data/balances.sql')));
        DB::connection('wallet')->unprepared(file_get_contents(database_path('data/operations.sql')));
        DB::connection('wallet')->unprepared(file_get_contents(database_path('data/transactions.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('wallet')->dropAllTables();
    }
};
