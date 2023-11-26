<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Country;
use App\Services\Zip\ZipInput\Sanitize\SanitizeASCII;

class CountryImport implements ToModel
{
    public function model(array $row)
    {
        return new Country([
            'name' => trim($this->sanitize($row[0])),
            'iso2' => trim($this->sanitize($row[1])),
            'region_id' => trim($this->sanitize($row[2])),
            'icon' => trim($this->sanitize($row[3])),

        ]);
    }

    private function sanitize($data)
    {
        return iconv('UTF-8', 'ASCII//TRANSLIT', $data);
    }
}