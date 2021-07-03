<?php

namespace App\Imports\Master;

use App\Models\Master\Student;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            $student = new Student();
            $student->student_name = $row['nama_lengkap'];
            $student->student_nisn = $row['nisn'];
            $student->student_nism = $row['nism'];
            $student->student_nik = $row['nism'];
            $student->student_birthplace = $row['tempat_lahir'];
            $student->student_birthday = Carbon::createFromFormat('d/m/Y', $row['tanggal_lahir'])->format('Y-m-d');
            $student->student_gender = $row['jk'];
            $student->student_address = $row['alamat'];
            $student->student_father_name = $row['nama_ayah'];
            $student->student_mother_name = $row['nama_ibu'];
            $student->save();
            $student->classes()->attach($student->student_id, ['class_id' => request('class_id')]);
        }
    }
}
