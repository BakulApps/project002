<?php

namespace Database\Seeders;

use App\Models\Graduate\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GraduateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(2)->create();

        $setting = [
            ['app_name', 'APLIKASI KELULUSAN'],
            ['app_alias', 'G-APP'],
            ['announcement_letter', ''],
            ['announcement_date', ''],
            ['announcement_skl', 0],
            ['app_logo', ''],

        ];
        for ($i=0;$i<count($setting);$i++){
            DB::table('graduate_entity__settings')->insert([
                'setting_name' => $setting[$i][0],
                'setting_value' => $setting[$i][1]
            ]);
        }
    }
}
