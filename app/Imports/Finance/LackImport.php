<?php

namespace App\Imports\Finance;

use App\Models\Master\Student;
use App\Models\Finance\Item;
use App\Models\Finance\Lack;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LackImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            $lack = new Lack();
            $lack->lack_item = Item::getFromCode($row['kode_biaya']);
            $lack->lack_student = Student::where('student_nisn', $row['nis'])->value('student_id');
            $lack->lack_cost = $row['total_tagihan'];
            $lack->save();
        }
    }
}
