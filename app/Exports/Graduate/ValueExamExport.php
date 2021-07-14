<?php

namespace App\Exports\Graduate;

use App\Models\Graduate\Student;
use App\Models\Master\Subject;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ValueExamExport implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array() : array
    {
        $student = Student::select('student_id', 'student_name')
            ->OrderBy('student_class')
            ->OrderBy('student_name')
            ->get()->toArray();
        return $student;
    }

    public function headings(): array
    {
        $subjects = Subject::OrderBy('subject_number')->get();
        foreach ($subjects as $subject){
            $heading[] = $subject->subject_code;
        }
        $heading = array_merge(['id_siswa', 'nama_siswa'], $heading);
        return $heading;
    }
}
