<?php

namespace Database\Seeders;

use App\Models\Student\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        User::factory(2)->create();
//
//        $school_from = [
//            [1, 'MA', 'MA'],
//            [2,	'SMA',	'MA'],
//            [3,	'SMK',	'MA'],
//            [4,	'Paket C',	'MA'],
//            [6,	'SMA di Luar Negeri',	'MA'],
//            [7,	'MTs',	'MTS'],
//            [8,	'SMP',	'MTS'],
//            [9,	'MI',	'MI'],
//            [10, 'SD',	'MI'],
//            [11, 'SDLB', 'MI'],
//            [12, 'SD di Luar Negeri', 'MI'],
//            [13, 'Lainnya', 00],
//            [14, 'RA', 'RA'],
//            [15, 'TK', 'RA'],
//            [16, 'PAUD', 'RA'],
//            [17, 'Langsung dari Orang Tua', 'RA'],
//            [18, 'Kelompok Bermain', 'RA'],
//            [19, 'Paket B', 'MA'],
//            [20, 'Pondok Pesantren', 'MA'],
//            [21, 'SMP di Luar Negeri', 'MA'],
//        ];
//        for ($i=0;$i<count($school_from);$i++){
//            DB::table('student_entity__schools_from')->insert(
//                [
//                    'from_id' => $school_from[$i][0],
//                    'from_name' => $school_from[$i][1],
//                    'from_category' => $school_from[$i][2]
//                ]
//            );
//        }
//
//        $school_kind = [
//            [1, 'MA', 'ma'],
//            [2, 'SMA', 'ma'],
//            [3, 'SMK', 'ma'],
//            [4, 'Paket C', 'ma'],
//            [5, 'Pondok Pesantren', 'ma'],
//            [6, 'SMA di Luar Negeri', 'ma'],
//            [0, '--', 'ma'],
//            [11, 'MTS', 'mts'],
//            [12, 'SMP', 'mts'],
//            [13, 'Paket B', 'mts'],
//            [14, 'Pondok Pesantren', 'mts'],
//            [15, 'SMP di Luar Negeri', 'mts'],
//            [10, '--', 'mts'],
//            [20, '--', 'mi'],
//            [21, 'MI', 'mi'],
//            [25, 'SD di Luar Negeri', 'mi'],
//            [24, 'Pondok Pesantren', 'mi'],
//            [23, 'Paket A', 'mi'],
//            [22, 'SD', 'mi'],
//            [30, '--', 'ra'],
//            [31, 'TK', 'ra'],
//            [32, 'RA', 'ra'],
//            [33, 'PAUD', 'ra']
//        ];
//        for ($i=0;$i<count($school_kind);$i++){
//            DB::table('student_entity__schools_kind')->insert(
//                [
//                    'kind_id' => $school_kind[$i][0],
//                    'kind_name' => $school_kind[$i][1],
//                    'kind_category' => $school_kind[$i][2]
//                ]
//            );
//        }
//
//        $contest_field = [
//            [1, 'Akademik'],
//            [2, 'Keagamaan'],
//            [3, 'Teknologi'],
//            [4, 'Olahraga'],
//            [5, 'Pramuka/Paskibraka'],
//            [6, 'Karya Ilmiah'],
//            [7, 'Kesenian'],
//            [8, 'Pidato Bahasa Asing'],
//            [9, 'Lainnya'],
//            [10, 'Sains'],
//        ];
//        for ($i=0;$i<count($contest_field);$i++){
//            DB::table('student_entity__contests_field')->insert(
//                [
//                    'field_id' => $contest_field[$i][0],
//                    'field_name' => $contest_field[$i][1],
//                ]
//            );
//        }
//
//        $contest_category = [
//            [1, 'Perorangan'],
//            [2, 'Kelompok']
//        ];
//        for ($i=0;$i<count($contest_category);$i++){
//            DB::table('student_entity__contests_category')->insert(
//                [
//                    'category_id' => $contest_category[$i][0],
//                    'category_name' => $contest_category[$i][1],
//                ]
//            );
//        }
//
//        $contest_achievement = [
//            [1, 'Tidak Meraih Juara'],
//            [2, 'Juara I/Medali Emas'],
//            [3, 'Juara II/Medali Perak'],
//            [4, 'Juara III/Medali Perunggu'],
//            [5, 'Juara Harapan I'],
//            [6, 'Juara Harapan II'],
//            [7, 'Juara Harapan III'],
//            [8, 'Juara Favorit']
//        ];
//        for ($i=0;$i<count($contest_achievement);$i++){
//            DB::table('student_entity__contests_achievement')->insert(
//                [
//                    'achievement_id' => $contest_achievement[$i][0],
//                    'achievement_name' => $contest_achievement[$i][1],
//                ]
//            );
//        }
//
//        $contest_level = [
//            [1, 'Tingkat Kabupaten/Kota'],
//            [2, 'Tingkat Provinsi'],
//            [3, 'Tingkat Nasional'],
//            [4, 'Tingkat Internasional']
//        ];
//        for ($i=0;$i<count($contest_level);$i++){
//            DB::table('student_entity__contests_level')->insert(
//                [
//                    'level_id' => $contest_level[$i][0],
//                    'level_name' => $contest_level[$i][1],
//                ]
//            );
//        }
//
//        $hobby = [
//            [1, 'Olahraga'],
//            [2, 'Kesenian'],
//            [3, 'Membaca'],
//            [4, 'Menulis'],
//            [5, 'Jalan-Jalan'],
//            [6, 'Lainnya']
//        ];
//        for ($i=0;$i<count($hobby);$i++){
//            DB::table('student_entity__hobbies')->insert(
//                [
//                    'hobby_id' => $hobby[$i][0],
//                    'hobby_name' => $hobby[$i][1],
//                ]
//            );
//        }
//
//        $purpose = [
//            [1, 'Lainnya'],
//            [2, 'PNS'],
//            [3, 'TNI/Polri'],
//            [4, 'Guru/Dosen'],
//            [5, 'Dokter'],
//            [6, 'Politikus'],
//            [7, 'Wiraswasta'],
//            [8, 'Seniman/Artis'],
//            [9, 'Ilmuwan'],
//            [10, 'Agamawan']
//        ];
//        for ($i=0;$i<count($purpose);$i++){
//            DB::table('student_entity__purposes')->insert(
//                [
//                    'purpose_id' => $purpose[$i][0],
//                    'purpose_name' => $purpose[$i][1]
//                ]
//            );
//        }
//
//        $residence = [
//            [1, 'Tinggal dengan Orangtua/Wali'],
//            [2, 'Ikut Saudara/Kerabat'],
//            [3, 'Asrama Madrasah'],
//            [4, 'Kontrak/Kost'],
//            [5, 'Asrama Pesantren'],
//            [6, 'Panti Asuhan'],
//            [7, 'Rumah Singgah'],
//            [8, 'Lainnya']
//        ];
//        for ($i=0;$i<count($residence);$i++){
//            DB::table('student_entity__residences')->insert(
//                [
//                    'residence_id' => $residence[$i][0],
//                    'residence_name' => $residence[$i][1]
//                ]
//            );
//        }
//
//        $program = [
//            [1, 'Unggulan Tahfidz'],
//            [2, 'Unggulan Kitab'],
//            [3, 'Unggulan Sains & Bahasa'],
//            [4, 'Kelas Reguler']
//        ];
//        for ($i=0;$i<count($program);$i++){
//            DB::table('student_entity__programs')->insert(
//                [
//                    'program_id' => $program[$i][0],
//                    'program_name' => $program[$i][1]
//                ]
//            );
//        }
//
//        $status = [
//            [1,	'Masih Hidup'],
//            [2,	'Sudah Meninggal'],
//            [3,	'Tidak Diketahui'],
//        ];
//        for ($i=0;$i<count($status);$i++){
//            DB::table('student_entity__parents_status')->insert(
//                [
//                    'status_id' => $status[$i][0],
//                    'status_name' => $status[$i][1]
//                ]
//            );
//        }
//
//        $setting = [
//            ['app_name', 'Sistem Informasi Madrasah Terpadu'],
//            ['app_alias', 'SIMADU'],
//            ['app_logo', ''],
//            ['app_desc', ''],
//
//        ];
//        for ($i=0;$i<count($setting);$i++){
//            DB::table('student_entity__settings')->insert([
//                'setting_name' => $setting[$i][0],
//                'setting_value' => $setting[$i][1]
//            ]);
//        }
    }
}
