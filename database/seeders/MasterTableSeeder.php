<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gender = ['Laki-laki', 'Perempuan'];

        for ($i=0;$i<count($gender);$i++){
            DB::table('entity__master_genders')->insert([
                    'gender_name' => $gender[$i]
                ]
            );
        }

        $religion   = ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Kong Hu Cu'];

        for ($i=0;$i<count($religion);$i++){
            DB::table('entity__master_religions')->insert([
                    'religion_name' => $religion[$i]
                ]
            );
        }

        $civic   = ['WNI', 'WNA'];

        for ($i=0;$i<count($civic);$i++){
            DB::table('entity__master_civics')->insert([
                    'civic_name' => $civic[$i]
                ]
            );
        }

        $distance = ['Kurang dari 5 Km', 'Antara 5 - 10 Km', 'Antara 11 - 20 Km', 'Antara 21 - 30 Km', 'Lebih dari 30 Km'];
        for ($i=0;$i<count($distance);$i++){
            DB::table('entity__master_distances')->insert([
                    'distance_name' => $distance[$i]
                ]
            );
        }

        $transport = [
            'Jalan Kaki',
            'Sepeda',
            'Sepeda Motor',
            'Mobil Pribadi',
            'Antar Jemput Sekolah',
            'Angkutan Umum',
            'Perahu/Sampan',
            'Lainnya'
        ];
        for ($i=0;$i<count($transport);$i++){
            DB::table('entity__master_transports')->insert([
                    'transport_name' => $transport[$i]
                ]
            );
        }

        $travel = ['< 10 Menit', '10-19 Menit', '20-29 Menit', '30-59 Menit', '1-2 Jam', '> 2 Jam'];

        for ($i=0;$i<count($travel);$i++){
            DB::table('entity__master_travels')->insert([
                    'travel_name' => $travel[$i]
                ]
            );
        }

        $study = [
            'SD/Sederajat',
            'SMP/Sederajat',
            'SMA/Sederajat',
            'D1',
            'D2',
            'D3',
            'D4/S1',
            'S2',
            'S3',
            'Tidak Bersekolah'
        ];
        for ($i=0;$i<count($study);$i++){
            DB::table('entity__master_studies')->insert([
                    'study_name' => $study[$i]
                ]
            );
        }

        $job = [
            'Tidak Bekerja',
            'Pensiunan',
            'PNS',
            'TNI/Polisi',
            'Guru/Dosen',
            'Pegawai Swasta',
            'Wiraswasta',
            'Pengacara/Jaksa/Hakim/Notaris',
            'Seniman/Pelukis/Artis/Sejenis',
            'Dokter/Bidan/Perawat',
            'Pilot/Pramugara',
            'Pedagang',
            'Petani/Peternak',
            'Nelayan',
            'Buruh (Tani/Pabrik/Bangunan)',
            'Sopir/Masinis/Kondektur',
            'Politikus',
            'Lainnya'
        ];
        for ($i=0;$i<count($job);$i++){
            DB::table('entity__master_jobs')->insert([
                    'job_name' => $job[$i]
                ]
            );
        }

        $earning = [
            'Kurang dari Rp 500.000',
            'Rp 500.000 - 1.000.000',
            'Rp 1.000.001 - 2.000.000',
            'Rp 2.000.001 - 3.000.000',
            'Rp 3.000.001 - 5.000.000',
            'Lebih dari Rp 5.000.000',
            'Tidak Ada'
        ];
        for ($i=0;$i<count($earning);$i++){
            DB::table('entity__master_earnings')->insert([
                    'earning_name' => $earning[$i]
                ]
            );
        }

        $home = [
            [9, 'Milik Sendiri'],
            [10, 'Rumah Orang Tua'],
            [11, 'Rumah Saudara/Kerabat'],
            [12, 'Rumah Dinas'],
            [13, 'Sewa/Kontrak'],
            [14, 'Lainnya'],
        ];
        for ($i=0;$i<count($home);$i++){
            DB::table('entity__master_homes')->insert([
                    'home_id' => $home[$i][0],
                    'home_name' => $home[$i][1]
                ]
            );
        }

        $years = [
            ['1', '2020/2021'],
            ['2', '2021/2022'],
            ['3', '2022/2023']
        ];

        for ($i=0; $i<count($years);$i++){
            DB::table('entity__master_years')->insert([
                'year_number' => $years[$i][0],
                'year_name' => $years[$i][1]
            ]);
        }

        $semesters = [ 'Semester Gasal', 'Semester Genap'];

        for ($i=0; $i<count($semesters);$i++){
            DB::table('entity__master_semesters')->insert([
                'semester_name' => $semesters[$i],
            ]);
        }

        $ladders = [
            ['MI', 'Madrasah Ibtidaiyah'],
            ['MTs', 'Madrasah Tsanawiyah'],
            ['MA', 'Madrasah Aliyah']
        ];

        for ($i=0; $i<count($ladders);$i++){
            DB::table('entity__master_ladders')->insert([
                'ladder_code' => $ladders[$i][0],
                'ladder_name' => $ladders[$i][1]
            ]);
        }

        $levels = [['1', '1'], ['1', '2'], ['1', '3'], ['1', '4'], ['1', '5'], ['1', '6'], ['2', '7'], ['2', '8'],
            ['2', '9'], ['3', '10'], ['3', '11'], ['3', '12']];

        for ($i=0; $i<count($levels);$i++){
            DB::table('entity__master_levels')->insert([
                'level_ladder' => $levels[$i][0],
                'level_name' => $levels[$i][1]
            ]);
        }

        $majors = ['NON JURUSAN', 'IPA', 'IPS', 'BAHASA', 'KEAGAMAAN'];

        for ($i=0; $i<count($majors);$i++){
            DB::table('entity__master_majors')->insert([
                'major_name' => $majors[$i],
            ]);
        }

        $classes = [
            ['1', '7', '1', '1', 'VII.1'],
            ['1', '7', '1', '2', 'VII.2'],
        ];

        for ($i=0; $i<count($classes);$i++){
            DB::table('entity__master_classes')->insert([
                'class_year' => $classes[$i][0],
                'class_level' => $classes[$i][1],
                'class_major' => $classes[$i][2],
                'class_name' => $classes[$i][3],
                'class_alias' => $classes[$i][4],
            ]);
        }


        DB::table('entity__master_schools')->insert([
            'school_npsn' => '20364236',
            'school_nsm' => '121233200005',
            'school_name' => 'Darul Hikmah',
            'school_nickname' => 'MTs. DH',
            'school_slug' => 'Tetap Berkreasi Tanpa Meninggalkan Tradisi',
            'school_status' => 2,
            'school_ladder' => 3,
            'school_npwp' => '00.512.882.2-516.000',
            'school_phone' => '082137956546',
            'school_website' => 'http://mts.darul-hikmah.sch.id',
            'school_email' => 'mtsdarulhikmahmenganti@yahoo.co.id',
            'school_since_year' => '1987',
            'school_since_deed' => 'AHU-0015608.AH.01.04.TAHUN 2015',
            'school_lisence_number' => 'AHU-0015608.AH.01.04.TAHUN 2015',
            'school_lisence_date' => '2015-10-05',
            'school_kemenkumham_number' => 'AHU-0015608.AH.01.04.TAHUN 2015',
            'school_kemenkumham_date' => '2015-10-05',
            'school_organizer' => 2,
            'school_fundation' => 'YAYASAN DARUL HIKMAH MENGANTI',
            'school_affiliate' => 1,
            'school_study_time' => 1,
            'school_kkm' => 2,
            'school_parent' => 1000,
            'school_committee' => 1,
            'school_address' => 'Jl. Raya Jepara - Bugel KM 07 Menganti',
            'school_village' => 2014,
            'school_subdistric' => 332001,
            'school_distric' => 3320,
            'school_province' => 33,
            'school_postal' => 59463,
            'school_headmaster_name' => 'Sholihin, S.Ag',
            'school_headmaster_nip' => '-',
            'school_logo' => ''
        ]);

        $banks = [
            ['BNI', 'Bank Negara Indonesia'],
            ['BRI', 'Bank Rakyat Indonesia'],
            ['BCA', 'Bank Central Asia'],
            ['MANDIRI', 'Bank Mandiri'],
            ['BTN', 'Bank Tabungan Negara'],
        ];

        for ($i=0; $i<count($banks);$i++){
            DB::table('entity__master_banks')->insert([
                'bank_code' => $banks[$i][0],
                'bank_name' => $banks[$i][1]
            ]);
        }
    }
}
