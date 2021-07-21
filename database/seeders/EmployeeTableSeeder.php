<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = [
            ['app_name', 'Sistem Informasi Madrasah Terpadu'],
            ['app_alias', 'SIMADU'],
            ['app_logo', ''],
            ['app_desc', ''],

        ];
        for ($i=0;$i<count($setting);$i++){
            DB::table('employee_entity__settings')->insert([
                'setting_name' => $setting[$i][0],
                'setting_value' => $setting[$i][1]
            ]);
        }
    }
}
