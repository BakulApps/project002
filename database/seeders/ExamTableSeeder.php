<?php

namespace Database\Seeders;

use App\Models\Exam\Classes;
use App\Models\Exam\Level;
use App\Models\Exam\Major;
use App\Models\Exam\Role;
use App\Models\Exam\Schedule;
use App\Models\Exam\Student;
use App\Models\Exam\Subject;
use App\Models\Exam\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Student::factory(10)->create();
        //Subject::factory(17)->create();
        //Level::factory(10)->create();
        //Major::factory(1)->create();
        //Classes::factory(10)->create();
        //Schedule::factory(20)->create();
        //Role::factory(1)->create();
        User::factory(2)->create();

        $setting = [
            ['app_name', 'PENILAIAN AKHIR SEMESTER'],
            ['app_alias', 'PAS'],
            ['school_logo', 'logo.png'],
            ['school_name', 'MTs. Darul Hikmah Menganti'],
            ['school_address', 'Jl. Bugel - Jepara KM 7 Menganti'],

        ];

        $level = [7, 8, 9];

        $role = [
            ['Administrator', 'Administrator'],
            ['Walikelas', 'Walikelas']
        ];

        for ($i=0;$i<count($setting);$i++){
            DB::table('exam_entity__settings')->insert([
                'setting_name' => $setting[$i][0],
                'setting_value' => $setting[$i][1]
            ]);
        }

        for ($i=0;$i<count($level);$i++){
            DB::table('exam_entity__levels')->insert([
                'level_name' => $level[$i]
            ]);
        }

        for ($i=0;$i<count($role);$i++){
            DB::table('exam_entity__roles')->insert([
                'role_name' => $role[$i][0],
                'role_desc' => $role[$i][1]
            ]);
        }
    }
}
