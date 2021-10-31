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

//        PortalSeeder
//        $this->call(PortalTableSeeder::class);
        $this->call(AdmissionTableSeeder::class);
        $this->call(MasterTableSeeder::class);
        $this->call(StudentTableSeeder::class);

//        ExamSeeder
//        $this->call(ExamTableSeeder::class);

//        GraduateSeeder
//        $this->call(GraduateTableSeeder::class);

//        FinanceSeeder
//        $this->call(FinanceTableSeeder::class);
//        $this->call(EmployeeTableSeeder::class);
    }
}
