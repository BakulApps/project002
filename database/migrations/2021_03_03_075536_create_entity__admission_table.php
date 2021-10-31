<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityAdmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_entity__settings', function (Blueprint $table) {
            $table->id('setting_id');
            $table->string('setting_name');
            $table->string('setting_value')->nullable();
        });

        Schema::create('admission_entity__students', function (Blueprint $table) {
            $table->id('student_id');
            $table->string('student_name', 100)->nullable();
            $table->string('student_nisn', 10)->unique()->nullable();
            $table->string('student_nik', 16)->unique();
            $table->string('student_birthplace', 50)->nullable();
            $table->date('student_birthday')->nullable();
            $table->integer('student_gender')->nullable();
            $table->integer('student_religion')->nullable();
            $table->string('student_siblingplace', 2)->nullable();
            $table->string('student_sibling', 2)->nullable();
            $table->integer('student_civic')->nullable();
            $table->integer('student_hobby')->nullable();
            $table->integer('student_purpose')->nullable();
            $table->string('student_email')->nullable();
            $table->string('student_phone')->nullable();
            $table->boolean('student_im_hepatitis')->default(0)->nullable();
            $table->boolean('student_im_polio')->default(0)->nullable();
            $table->boolean('student_im_bcg')->default(0)->nullable();
            $table->boolean('student_im_campak')->default(0)->nullable();
            $table->boolean('student_im_dpt')->default(0)->nullable();
            $table->boolean('student_im_covid')->default(0)->nullable();
            $table->integer('student_residence')->nullable();
            $table->string('student_address', 200)->nullable();
            $table->integer('student_province')->nullable();
            $table->integer('student_distric')->nullable();
            $table->integer('student_subdistric')->nullable();
            $table->integer('student_village')->nullable();
            $table->string('student_postal', 5)->nullable();
            $table->integer('student_distance')->nullable();
            $table->integer('student_transport')->nullable();
            $table->integer('student_travel')->nullable();
            $table->integer('student_program')->nullable();
            $table->integer('student_boarding')->nullable();
            $table->string('student_no_kk', 16)->nullable();
            $table->string('student_head_family', 200)->nullable();
            $table->string('student_father_name', 100)->nullable();
            $table->string('student_mother_name', 100)->nullable();
            $table->date('student_father_birthday')->nullable();
            $table->date('student_mother_birthday')->nullable();
            $table->integer('student_father_status')->nullable();
            $table->integer('student_mother_status')->nullable();
            $table->string('student_father_nik', 16)->nullable();
            $table->string('student_mother_nik', 16)->nullable();
            $table->integer('student_father_study')->nullable();
            $table->integer('student_mother_study')->nullable();
            $table->integer('student_father_job')->nullable();
            $table->integer('student_mother_job')->nullable();
            $table->integer('student_father_earning')->nullable();
            $table->integer('student_mother_earning')->nullable();
            $table->string('student_father_phone', 13)->nullable();
            $table->string('student_mother_phone', 13)->nullable();
            $table->integer('student_home_owner')->nullable();
            $table->string('student_home_address', 200)->nullable();
            $table->string('student_home_postal', 6)->nullable();
            $table->integer('student_home_province')->nullable();
            $table->integer('student_home_distric')->nullable();
            $table->integer('student_home_subdistric')->nullable();
            $table->integer('student_home_village')->nullable();
            $table->integer('student_school_from')->nullable();
            $table->string('student_school_name', 100)->nullable();
            $table->string('student_school_npsn', 8)->nullable();
            $table->string('student_school_address')->nullable();
            $table->boolean('student_swaphoto')->default(0);
            $table->boolean('student_akta_photo')->default(0);
            $table->boolean('student_kk_photo')->default(0);
            $table->boolean('student_ijazah_photo')->default(0);
            $table->boolean('student_skhun_photo')->default(0);
            $table->boolean('student_sholarship_photo')->default(0);
            $table->timestamps();
        });

        Schema::create('admission_entity__forms', function (Blueprint $table) {
            $table->id('form_id');
            $table->string('form_uuid');
            $table->string('form_letter', 100)->nullable();
            $table->string('form_student');
            $table->date('form_date');
            $table->integer('form_count');
        });

        Schema::create('admission_entity__roles', function (Blueprint $table){
            $table->id('role_id');
            $table->string('role_name');
            $table->string('role_desc')->nullable();
        });;

        Schema::create('admission_entity__users', function (Blueprint $table){
            $table->id('user_id');
            $table->string('user_fullname', 200);
            $table->string('user_name', 100);
            $table->string('user_pass');
            $table->string('user_email')->nullable();
            $table->string('user_role');
            $table->mediumText('user_desc')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admission_entity__settings');
        Schema::dropIfExists('admission_entity__students');
        Schema::dropIfExists('admission_entity__forms');
        Schema::dropIfExists('admission_entity__roles');
        Schema::dropIfExists('admission_entity__users');
    }
}
