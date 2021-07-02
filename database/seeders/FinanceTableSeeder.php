<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['TTL', 'Tagihan Tahun Lalu'],
            ['SRG', 'Seragam Sekolah'],
            ['KLD', 'Kalender'],
            ['UJI', 'Ujian Akhir'],
            ['RPT', 'Sampul Raport K-13'],
            ['KTA', 'Kartu OSIS'],
            ['DFU', 'Daftar Ulang'],
            ['EKS', 'Ekstrakurikuler'],
            ['IFQ', 'Infaq'],
            ['HRL', 'Harlah'],
            ['SPP', 'SPP'],
            ['LKS', 'LKS Gasal'],
            ['M.1', 'MID Gasal'],
            ['S.1', 'Semester Gasal'],
            ['SNC', 'Snack Raport'],
            ['LK2', 'LKS Genap'],
            ['M.2', 'MID Genap'],
            ['S.2', 'Semester Genap'],
            ['UPB', 'Uang Pangkal Boarding'],
            ['SRB', 'Seragam Boarding'],
            ['UMB', 'Uang Makan Boarding'],
            ['DNY', 'SPP Diniyah'],
            ['RDY', 'Raport Diniyah'],
            ['LKD', 'LKS Diniyah'],
            ['KTP', 'KTA Ponpes'],
            ['CWU', 'Cawu Diniyah'],
            ['UJD', 'Ujian Diniyah'],
            ['MWD', 'Muwaddaah'],
            ['RKS', 'Rekreasi'],
            ['KTB', 'Kitab Boarding'],
            ['SWK', 'Sewa Almari Ponpes'],
            ['JSB', 'Jas Boarding'],
        ];

        for ($i=0; $i<count($items);$i++){
            DB::table('finance_entity__items')->insert([
                'item_code' => $items[$i][0],
                'item_name' => $items[$i][1]
            ]);
        }

        $accounts = [
            ['2', '588901011409501', 'MTs. Darul Hikmah Menganti']
        ];

        for ($i=0; $i<count($accounts);$i++){
            DB::table('finance_entity__accounts')->insert([
                'account_bank' => $accounts[$i][0],
                'account_number' => $accounts[$i][1],
                'account_name' => $accounts[$i][2]
            ]);
        }
    }
}
