<?php

namespace App\Imports;

use App\Models\RawMaterial;
use Maatwebsite\Excel\Concerns\ToModel;

class RawMaterialImport implements ToModel
{
    public function model(array $row)
    {
        return new RawMaterial([
            'code' => $row[0],
            'name' => $row[1],
            'image' => $row[2],
            'description' => $row[3],
            'lot' => $row[4],
            'dimension1' => $row[5],
            'dimension2' => $row[6],
            'unit' => $row[7],
            'supplier_id' => $row[8],
            'quantity' => $row[9],
            'unit_cost' => $row[10],
            'total_cost' => $row[11],
        ]);
    }
}

