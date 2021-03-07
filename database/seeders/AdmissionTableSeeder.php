<?php

namespace Database\Seeders;

use App\Models\Admission\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdmissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = [
            ['app_name', 'Penerimaan Peserta Didik Baru'],
            ['app_alias', 'PPDB Online'],
            ['app_year', '2021/2022'],
            ['school_logo', 'storage/admission/fronted/images/logo.png'],
            ['school_name', 'MTs. Darul Hikmah Menganti'],
            ['school_address', 'Jl. Bugel - Jepara KM 7 Menganti'],

        ];

        for ($i=0;$i<count($setting);$i++){
            DB::table('admission_entity__settings')->insert([
                'setting_name' => $setting[$i][0],
                'setting_value' => $setting[$i][1]
            ]);
        }

        User::factory(2)->create();
    }
}
