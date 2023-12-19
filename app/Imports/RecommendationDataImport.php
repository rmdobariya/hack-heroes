<?php

namespace App\Imports;

use App\Models\UserData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RecommendationDataImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return $row;

    }
}
