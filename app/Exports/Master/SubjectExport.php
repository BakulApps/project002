<?php

namespace App\Exports\Master;

use Maatwebsite\Excel\Concerns\FromArray;

class SubjectExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array() : array
    {
        return [
            ['no_urut', 'kode_mapel', 'nama_mapel', 'diskripsi_mapel', 'mapel_un'],
            ['1', 'MTK', 'Matematika', 'Matematika Dasar', '1'],
            ['2', 'AQH', 'Al Quran Hadist', 'Pelajaran Agama', '']
        ];
    }
}
