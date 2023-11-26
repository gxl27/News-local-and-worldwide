<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Imports\CountryImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class CountryTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
  
        $filePath = 'database/data/countries.xls';

        Excel::import(new CountryImport(), $filePath);
    }
}
