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
            ['app_logo', ''],
            ['app_desc', '']

        ];

        for ($i=0;$i<count($setting);$i++){
            DB::table('admission_entity__settings')->insert([
                'setting_name' => $setting[$i][0],
                'setting_value' => $setting[$i][1]
            ]);
        }

        $roles = [
            ['Administrator', ''],
            ['Keuangan', '']
        ];

        for ($i=0;$i<count($roles);$i++){
            DB::table('admission_entity__roles')->insert([
                'role_name' => $roles[$i][0],
            ]);
        }

        User::factory(2)->create();
    }
}
