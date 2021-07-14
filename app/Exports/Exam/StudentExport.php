<?php

namespace App\Exports\Exam;

use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return ['no_peserta', 'nama_lengkap', 'kelas', 'username', 'password'];
    }
}
