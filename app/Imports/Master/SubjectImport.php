<?php

namespace App\Imports\Master;

use App\Models\Master\Subject;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubjectImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Subject([
            'subject_number' => $row['no_urut'],
            'subject_code' => $row['kode_mapel'],
            'subject_name' => $row['nama_mapel'],
            'subject_desc' => $row['diskripsi_mapel'],
            'subject_exam' => $row['mapel_un'],
        ]);
    }
}
