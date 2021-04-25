<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        //PortalSeeder
        $this->call(PortalTableSeeder::class);
        $this->call(AdmissionTableSeeder::class);
        $this->call(MasterTableSeeder::class);
        $this->call(StudentTableSeeder::class);

        //ExamSeeder
        $this->call(ExamTableSeeder::class);

        //GraduateSeeder
        $this->call(GraduateTableSeeder::class);
    }
}
