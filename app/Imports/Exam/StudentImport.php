<?php

namespace App\Imports\Exam;

use App\Models\Exam\Student;
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
            $student->student_number        = $row['no_peserta'];
            $student->student_name          = $row['nama_lengkap'];
            $student->student_class         = $row['kelas'];
            $student->student_username      = $row['username'];
            $student->student_password      = $row['password'];
            $student->save();
        }
    }
}
