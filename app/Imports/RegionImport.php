<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Region;
use App\Services\Zip\ZipInput\Sanitize\SanitizeASCII;

class RegionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Region([
            'name' => trim($this->sanitize($row[0])),
            'iso2' => trim($this->sanitize($row[1])),
            'image' => trim($this->sanitize($row[2])),
        ]);
    }

    private function sanitize($data)
    {
        return iconv('UTF-8', 'ASCII//TRANSLIT', $data);
    }
}