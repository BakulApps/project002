<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('entity__master_genders', function (Blueprint $table) {
//            $table->id('gender_id');
//            $table->string('gender_name', 20);
//        });
//
//        Schema::create('entity__master_religions', function (Blueprint $table) {
//            $table->id('religion_id');
//            $table->string('religion_name', 20);
//        });
//
//        Schema::create('entity__master_civics', function (Blueprint $table) {
//            $table->id('civic_id');
//            $table->string('civic_name', 20);
//        });

//        Schema::create('entity__master_territories', function (Blueprint $table) {
//            $table->integer('code_province');
//            $table->integer('code_distric');
//            $table->integer('code_subdistric');
//            $table->integer('code_village');
//            $table->string('name_village', 100);
//            $table->string('name_subdistric', 100);
//            $table->string('name_distric', 100);
//            $table->string('name_province', 100);
//            $table->integer('id_province');
//            $table->integer('id_distric');
//            $table->integer('id_subdistric');
//            $table->integer('id_village');
//        });

//        Schema::create('entity__master_distances', function (Blueprint $table) {
//            $table->id('distance_id');
//            $table->string('distance_name', 50);
//        });
//
//        Schema::create('entity__master_transports', function (Blueprint $table) {
//            $table->id('transport_id');
//            $table->string('transport_name', 50);
//        });
//
//        Schema::create('entity__master_travels', function (Blueprint $table) {
//            $table->id('travel_id');
//            $table->string('travel_name', 50);
//        });
//
//        Schema::create('entity__master_studies', function (Blueprint $table) {
//            $table->id('study_id');
//            $table->string('study_name', 50);
//        });
//
//        Schema::create('entity__master_jobs', function (Blueprint $table) {
//            $table->id('job_id');
//            $table->string('job_name', 50);
//        });
//
//        Schema::create('entity__master_earnings', function (Blueprint $table) {
//            $table->id('earning_id');
//            $table->string('earning_name', 50);
//        });
//
//        Schema::create('entity__master_homes', function (Blueprint $table) {
//            $table->id('home_id');
//            $table->string('home_name', 50);
//        });
//
//        Schema::create('entity__master_years', function (Blueprint $table) {
//            $table->id('year_id');
//            $table->string('year_number');
//            $table->string('year_name');
//            $table->mediumText('year_desc')->nullable();
//            $table->boolean('year_active')->default(0);
//        });
//
//        Schema::create('entity__master_semesters', function (Blueprint $table) {
//            $table->id('semester_id');
//            $table->string('semester_name', 50)->nullable();
//            $table->mediumText('semester_desc')->nullable();
//            $table->boolean('semester_active')->default(0);
//        });
//
//        Schema::create('entity__master_ladders', function (Blueprint $table) {
//            $table->id('ladder_id');
//            $table->string('ladder_code');
//            $table->string('ladder_name');
//            $table->mediumText('ladder_desc')->nullable();
//        });
//
//        Schema::create('entity__master_levels', function (Blueprint $table){
//            $table->id('level_id');
//            $table->string('level_ladder', 2)->nullable();
//            $table->string('level_name', 2)->nullable();
//        });
//
//        Schema::create('entity__master_majors', function (Blueprint $table){
//            $table->id('major_id');
//            $table->string('major_name', 50)->nullable();
//        });
//
//        Schema::create('entity__master_classes', function (Blueprint $table){
//            $table->id('class_id');
//            $table->string('class_year', 2)->nullable();
//            $table->string('class_level', 2)->nullable();
//            $table->string('class_major', 2)->nullable();
//            $table->string('class_name', 2)->nullable();
//            $table->string('class_alias', 50)->nullable();
//        });

//        Schema::create('entity__master_schools', function (Blueprint $table) {
//            $table->id('school_id');
//            $table->string('school_npsn', 8)->nullable();
//            $table->string('school_nsm', 12)->nullable();
//            $table->string('school_name', 100)->nullable();
//            $table->string('school_nickname', 50)->nullable();
//            $table->string('school_slug', 200)->nullable();
//            $table->string('school_status', 50)->nullable();
//            $table->string('school_ladder', 2)->nullable();
//            $table->string('school_npwp', 20)->nullable();
//            $table->string('school_phone', 15)->nullable();
//            $table->string('school_website', 100)->nullable();
//            $table->string('school_email', 200)->nullable();
//            $table->string('school_since_year', 4)->nullable();
//            $table->string('school_since_deed', 100)->nullable();
//            $table->string('school_lisence_number', 100)->nullable();
//            $table->date('school_lisence_date')->nullable();
//            $table->string('school_kemenkumham_number', 200)->nullable();
//            $table->date('school_kemenkumham_date')->nullable();
//            $table->string('school_organizer', 2)->nullable();
//            $table->string('school_fundation', 100)->nullable();
//            $table->string('school_affiliate', 100)->nullable();
//            $table->string('school_study_time', 2)->nullable();
//            $table->string('school_kkm', 2)->nullable();
//            $table->string('school_parent', 4)->nullable();
//            $table->string('school_committee', 2)->nullable();
//            $table->string('school_address', 200)->nullable();
//            $table->string('school_village', 4)->nullable();
//            $table->string('school_subdistric', 6)->nullable();
//            $table->string('school_distric', 4)->nullable();
//            $table->string('school_province', 2)->nullable();
//            $table->string('school_postal', 6)->nullable();
//            $table->string('school_headmaster_name')->nullable();
//            $table->string('school_headmaster_nip')->nullable();
//            $table->string('school_logo')->nullable();
//        });
//
//        Schema::create('entity__master_students', function (Blueprint $table) {
//            $table->id('student_id');
//            $table->string('student_name', 100)->nullable();
//            $table->string('student_nisn', 10)->unique();
//            $table->string('student_nism', 20)->unique();
//            $table->integer('student_civic')->nullable();
//            $table->string('student_nik', 16)->unique();
//            $table->string('student_birthplace', 50)->nullable();
//            $table->date('student_birthday')->nullable();
//            $table->integer('student_gender')->nullable();
//            $table->string('student_siblingplace', 2)->nullable();
//            $table->string('student_sibling', 2)->nullable();
//            $table->string('student_religion', 2)->nullable();
//            $table->string('student_purpose', 2)->nullable();
//            $table->string('student_phone', 14)->nullable();
//            $table->string('student_mail', 100)->nullable();
//            $table->string('student_hobby', 2)->nullable();
//            $table->string('student_residence', 2)->nullable();
//            $table->string('student_address', 200)->nullable();
//            $table->string('student_province', 2)->nullable();
//            $table->string('student_distric', 4)->nullable();
//            $table->string('student_subdistric', 6)->nullable();
//            $table->string('student_village', 4)->nullable();
//            $table->string('student_postal', 5)->nullable();
//            $table->string('student_transport', 2)->nullable();
//            $table->string('student_distance', 2)->nullable();
//            $table->string('student_travel', 2)->nullable();
//            $table->string('student_financed', 2)->nullable();
//
//            $table->boolean('student_im_hepatitis')->default(0)->nullable();
//            $table->boolean('student_im_polio')->default(0)->nullable();
//            $table->boolean('student_im_bcg')->default(0)->nullable();
//            $table->boolean('student_im_campak')->default(0)->nullable();
//            $table->boolean('student_im_dpt')->default(0)->nullable();
//            $table->boolean('student_im_covid')->default(0)->nullable();
//            $table->boolean('student_tk')->default(0)->nullable();
//            $table->boolean('student_paud')->default(0)->nullable();
//
//            $table->string('student_kip_no', 10)->nullable();
//            $table->string('student_kip_file')->nullable();
//            $table->string('student_kk_file')->nullable();
//
//
//            $table->string('student_kk_no', 16)->nullable();
//            $table->string('student_head_family', 200)->nullable();
//            $table->string('student_father_name', 100)->nullable();
//            $table->string('student_father_status', 2)->nullable();
//            $table->string('student_father_civic', 2)->nullable();
//            $table->string('student_father_nik', 16)->nullable();
//            $table->string('student_father_birthplace', 50)->nullable();
//            $table->date('student_father_birthday')->nullable();
//            $table->string('student_father_study', 2)->nullable();
//            $table->string('student_father_job', 2)->nullable();
//            $table->string('student_father_earning', 2)->nullable();
//            $table->string('student_father_phone', 14)->nullable();
//
//            $table->string('student_mother_name', 100)->nullable();
//            $table->string('student_mother_status', 2)->nullable();
//            $table->string('student_mother_civic', 2)->nullable();
//            $table->string('student_mother_nik', 16)->nullable();
//            $table->string('student_mother_birthplace', 50)->nullable();
//            $table->date('student_mother_birthday')->nullable();
//            $table->string('student_mother_study')->nullable();
//            $table->string('student_mother_job')->nullable();
//            $table->string('student_mother_earning')->nullable();
//            $table->string('student_mother_phone', 13)->nullable();
//
//            $table->string('student_regent_name', 100)->nullable();
//            $table->string('student_regent_status', 2)->nullable();
//            $table->string('student_regent_civic', 2)->nullable();
//            $table->string('student_regent_nik', 16)->nullable();
//            $table->string('student_regent_birthplace', 50)->nullable();
//            $table->date('student_regent_birthday')->nullable();
//            $table->string('student_regent_study')->nullable();
//            $table->string('student_regent_job')->nullable();
//            $table->string('student_regent_earning')->nullable();
//            $table->string('student_regent_phone', 13)->nullable();
//
//            $table->string('student_home_domicile', 2)->nullable();
//            $table->string('student_home_owner', 2)->nullable();
//            $table->string('student_home_province', 2)->nullable();
//            $table->string('student_home_distric', 4)->nullable();
//            $table->string('student_home_subdistric', 6)->nullable();
//            $table->string('student_home_village', 4)->nullable();
//            $table->string('student_home_address', 200)->nullable();
//            $table->string('student_home_postal', 6)->nullable();
//            $table->string('student_kks_no', 50)->nullable();
//            $table->string('student_kks_file', 50)->nullable();
//            $table->string('student_pkh_no', 50)->nullable();
//            $table->string('student_pkh_file', 50)->nullable();
//
//            $table->string('student_photo_file')->nullable();
//            $table->string('student_akta_file')->nullable();
//            $table->string('student_ijazah_file')->nullable();
//            $table->string('student_skhun_file')->nullable();
//            $table->timestamps();
//        });

//        Schema::create('entity__master_banks', function (Blueprint $table){
//            $table->id('bank_id');
//            $table->string('bank_code', 20)->nullable();
//            $table->string('bank_name', 100)->nullable();
//        });
//
//        Schema::create('entity__master_subjects', function (Blueprint $table) {
//            $table->id('subject_id');
//            $table->integer('subject_number');
//            $table->string('subject_code')->unique();
//            $table->string('subject_name');
//            $table->boolean('subject_exam');
//            $table->mediumText('subject_desc')->nullable();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('entity__master_genders');
//        Schema::dropIfExists('entity__master_religions');
//        Schema::dropIfExists('entity__master_civics');
////        Schema::dropIfExists('entity__master_territories');
//        Schema::dropIfExists('entity__master_distances');
//        Schema::dropIfExists('entity__master_transports');
//        Schema::dropIfExists('entity__master_travels');
//        Schema::dropIfExists('entity__master_studies');
//        Schema::dropIfExists('entity__master_jobs');
//        Schema::dropIfExists('entity__master_earnings');
//        Schema::dropIfExists('entity__master_homes');
//        Schema::dropIfExists('entity__master_years');
//        Schema::dropIfExists('entity__master_semesters');
//        Schema::dropIfExists('entity__master_ladders');
//        Schema::dropIfExists('entity__master_levels');
//        Schema::dropIfExists('entity__master_classes');
//        Schema::dropIfExists('entity__master_majors');
//        Schema::dropIfExists('entity__master_schools');
//        Schema::dropIfExists('entity__master_students');
//        Schema::dropIfExists('entity__master_banks');
//        Schema::dropIfExists('entity__master_subjects');
    }
}
