<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportDBWalletSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('wallet')->unprepared(file_get_contents(database_path('data/balances.sql')));
        DB::connection('wallet')->unprepared(file_get_contents(database_path('data/operations.sql')));
        DB::connection('wallet')->unprepared(file_get_contents(database_path('data/transactions.sql')));
    }
}
