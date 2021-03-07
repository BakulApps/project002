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
        $gender = [[1, 'Laki-laki'], [2, 'Perempuan']];

        for ($i=0;$i<count($gender);$i++){
            DB::table('entity__master_genders')->insert(
                [
                    'gender_id' => $gender[$i][0],
                    'gender_name' => $gender[$i][1]
                ]
            );
        }

        $religion   = [
            [1, 'Islam'],
            [2, 'Kristen Protestan'],
            [3, 'Katolik'],
            [4, 'Hindu'],
            [5, 'Buddha'],
            [6, 'Kong Hu Cu']
        ];

        for ($i=0;$i<count($religion);$i++){
            DB::table('entity__master_religions')->insert(
                [
                    'religion_id' => $religion[$i][0],
                    'religion_name' => $religion[$i][1]
                ]
            );
        }

        $civic   = [[1, 'WNI'], [2, 'WNA']];

        for ($i=0;$i<count($civic);$i++){
            DB::table('entity__master_civics')->insert(
                [
                    'civic_id' => $civic[$i][0],
                    'civic_name' => $civic[$i][1]
                ]
            );
        }

        $distance = [
            [1, 'Kurang dari 5 Km'],
            [2, 'Antara 5 - 10 Km'],
            [3, 'Antara 11 - 20 Km'],
            [4, 'Antara 21 - 30 Km'],
            [5, 'Lebih dari 30 Km']
        ];
        for ($i=0;$i<count($distance);$i++){
            DB::table('entity__master_distances')->insert(
                [
                    'distance_id' => $distance[$i][0],
                    'distance_name' => $distance[$i][1]
                ]
            );
        }

        $transport = [
            [1, 'Jalan Kaki'],
            [2, 'Sepeda'],
            [3, 'Sepeda Motor'],
            [4, 'Mobil Pribadi'],
            [5, 'Antar Jemput Sekolah'],
            [6, 'Angkutan Umum'],
            [7, 'Perahu/Sampan'],
            [8, 'Lainnya']
        ];
        for ($i=0;$i<count($transport);$i++){
            DB::table('entity__master_transports')->insert(
                [
                    'transport_id' => $transport[$i][0],
                    'transport_name' => $transport[$i][1]
                ]
            );
        }

        $travel = [
            [1, '< 10 Menit'],
            [2, '10-19 Menit'],
            [3, '20-29 Menit'],
            [4, '30-59 Menit'],
            [5, '1-2 Jam'],
            [6, '> 2 Jam'],
        ];
        for ($i=0;$i<count($travel);$i++){
            DB::table('entity__master_travels')->insert(
                [
                    'travel_id' => $travel[$i][0],
                    'travel_name' => $travel[$i][1]
                ]
            );
        }

        $study = [
            [0, 'Tidak Berpendidikan'],
            [1, 'SD/Sederajat'],
            [2, 'SMP/Sederajat'],
            [3, 'SMA/Sederajat'],
            [4, 'D1'],
            [5, 'D2'],
            [6, 'D3'],
            [7, 'D4/S1'],
            [8, 'S2'],
            [9, 'S3']
        ];
        for ($i=0;$i<count($study);$i++){
            DB::table('entity__master_studies')->insert(
                [
                    'study_id' => $study[$i][0],
                    'study_name' => $study[$i][1]
                ]
            );
        }

        $job = [
            ['01', 'Tidak Bekerja'],
            ['02', 'Pensiunan'],
            ['03', 'PNS (Selain poin 05 dan 10)'],
            ['04', 'TNI/Polisi'],
            ['05', 'Guru/Dosen'],
            ['06', 'Pegawai Swasta'],
            ['07', 'Wiraswasta/Wirausaha'],
            ['08', 'Pengacara/Hakim/Jaksa/Notaris'],
            ['09', 'Seniman/Pelukis/Artis/Sejenis'],
            ['10', 'Dokter/Bidan/Perawat'],
            ['11', 'Pilot/Pramugara'],
            ['12', 'Pedagang'],
            ['13', 'Petani/Peternak'],
            ['14', 'Nelayan'],
            ['15', 'Buruh (Tani/Pabrik/Bangunan)'],
            ['16', 'Sopir/Masinis/Kondektur'],
            ['17', 'Politikus'],
            ['18', 'Lainnya'],
        ];
        for ($i=0;$i<count($job);$i++){
            DB::table('entity__master_jobs')->insert(
                [
                    'job_id' => $job[$i][0],
                    'job_name' => $job[$i][1]
                ]
            );
        }

        $earning = [
            [1, 'Kurang dari Rp 500.000'],
            [2, 'Rp 500.000 - 1.000.000'],
            [3, 'Rp 1.000.001 - 2.000.000'],
            [4, 'Rp 2.000.001 - 3.000.000'],
            [5, 'Rp 3.000.001 - 5.000.000'],
            [6, 'Lebih dari Rp 5.000.000'],
            [9, 'Tidak Ada'],
        ];
        for ($i=0;$i<count($earning);$i++){
            DB::table('entity__master_earnings')->insert(
                [
                    'earning_id' => $earning[$i][0],
                    'earning_name' => $earning[$i][1]
                ]
            );
        }

        $home = [
            [1, 'Milik Sendiri'],
            [2, 'Rumah Orang Tua'],
            [3, 'Rumah Saudara/Kerabat'],
            [4, 'Rumah Dinas'],
            [5, 'Sewa/Kontrak'],
            [6, 'Lainnya'],
        ];
        for ($i=0;$i<count($home);$i++){
            DB::table('entity__master_homes')->insert(
                [
                    'home_id' => $home[$i][0],
                    'home_name' => $home[$i][1]
                ]
            );
        }
    }
}
