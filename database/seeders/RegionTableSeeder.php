<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Region;
use App\Models\Country;
use Illuminate\Database\Seeder;
use App\Imports\RegionImport;
use Maatwebsite\Excel\Facades\Excel;

class RegionTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
  
        $filePath = 'database/data/regions.xls';

        Excel::import(new RegionImport(), $filePath);
    }
}
