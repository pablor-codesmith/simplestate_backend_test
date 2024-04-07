<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportDBMainSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared(file_get_contents(database_path('data/users.sql')));
        DB::unprepared(file_get_contents(database_path('data/projects.sql')));
        DB::unprepared(file_get_contents(database_path('data/investments.sql')));
        DB::unprepared(file_get_contents(database_path('data/account_banks.sql')));
    }
}
