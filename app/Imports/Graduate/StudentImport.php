<?php

namespace App\Imports\Graduate;

use App\Models\Graduate\Student;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Student([
            'student_name' => $row['nama_lengkap'],
            'student_nisn' => $row['nisn'],
            'student_nism' => $row['nism'],
            'student_number_exam' => $row['no_ujian'],
            'student_class' => $row['kelas'],
            'student_place_birth' => $row['tempat_lahir'],
            'student_birthday' => Carbon::createFromFormat('d/m/Y', $row['tanggal_lahir'])->format('Y-m-d'),
            'student_gender' => $row['jk'],
            'student_address' => $row['alamat'],
            'student_father' => $row['nama_ayah'],
            'student_mother' => $row['nama_ibu'],
        ]);
    }
}
