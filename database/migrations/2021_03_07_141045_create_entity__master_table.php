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
        Schema::create('entity__master_genders', function (Blueprint $table) {
            $table->integer('gender_id');
            $table->string('gender_name', 20);
        });

        Schema::create('entity__master_religions', function (Blueprint $table) {
            $table->integer('religion_id');
            $table->string('religion_name', 20);
        });

        Schema::create('entity__master_civics', function (Blueprint $table) {
            $table->integer('civic_id');
            $table->string('civic_name', 20);
        });

        //Schema::create('entity__master_territories', function (Blueprint $table) {
        //    $table->integer('code_province');
        //    $table->integer('code_distric');
        //    $table->integer('code_subdistric');
        //    $table->integer('code_village');
        //    $table->string('name_village', 100);
        //    $table->string('name_subdistric', 100);
        //    $table->string('name_distric', 100);
        //    $table->string('name_province', 100);
        //    $table->integer('id_province');
        //    $table->integer('id_distric');
        //    $table->integer('id_subdistric');
        //    $table->integer('id_village');
        //});

        Schema::create('entity__master_distances', function (Blueprint $table) {
            $table->integer('distance_id');
            $table->string('distance_name', 50);
        });

        Schema::create('entity__master_transports', function (Blueprint $table) {
            $table->integer('transport_id');
            $table->string('transport_name', 50);
        });

        Schema::create('entity__master_travels', function (Blueprint $table) {
            $table->integer('travel_id');
            $table->string('travel_name', 50);
        });

        Schema::create('entity__master_studies', function (Blueprint $table) {
            $table->integer('study_id');
            $table->string('study_name', 50);
        });

        Schema::create('entity__master_jobs', function (Blueprint $table) {
            $table->integer('job_id');
            $table->string('job_name', 50);
        });

        Schema::create('entity__master_earnings', function (Blueprint $table) {
            $table->integer('earning_id');
            $table->string('earning_name', 50);
        });

        Schema::create('entity__master_homes', function (Blueprint $table) {
            $table->integer('home_id');
            $table->string('home_name', 50);
        });

        Schema::create('entity__master_years', function (Blueprint $table) {
            $table->id('year_id');
            $table->integer('year_number');
            $table->string('year_name');
            $table->mediumText('year_desc')->nullable();
        });

        Schema::create('entity__master_ladders', function (Blueprint $table) {
            $table->id('ladder_id');
            $table->string('ladder_code');
            $table->string('ladder_name');
            $table->mediumText('ladder_desc')->nullable();
        });

        Schema::create('entity__master_schools', function (Blueprint $table) {
            $table->id('school_id');
            $table->string('school_fundation')->nullable();
            $table->string('school_ladder')->nullable();
            $table->string('school_name')->nullable();
            $table->string('school_slug')->nullable();
            $table->string('school_logo')->nullable();
            $table->string('school_nsm')->nullable();
            $table->string('school_npsn')->nullable();
            $table->string('school_phone')->nullable();
            $table->string('school_email')->nullable();
            $table->string('school_website')->nullable();
            $table->string('school_address')->nullable();
            $table->string('school_postal')->nullable();
            $table->string('school_headmaster_name')->nullable();
            $table->string('school_headmaster_nip')->nullable();
        });

        Schema::create('entity__master_subjects', function (Blueprint $table) {
            $table->id('subject_id');
            $table->integer('subject_number');
            $table->string('subject_code')->unique();
            $table->string('subject_name');
            $table->boolean('subject_exam');
            $table->mediumText('subject_desc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity__master_genders');
        Schema::dropIfExists('entity__master_religions');
        Schema::dropIfExists('entity__master_civics');
        //Schema::dropIfExists('entity__master_territories');
        Schema::dropIfExists('entity__master_distances');
        Schema::dropIfExists('entity__master_transports');
        Schema::dropIfExists('entity__master_travels');
        Schema::dropIfExists('entity__master_studies');
        Schema::dropIfExists('entity__master_jobs');
        Schema::dropIfExists('entity__master_earnings');
        Schema::dropIfExists('entity__master_homes');
        Schema::dropIfExists('entity__master_years');
        Schema::dropIfExists('entity__master_ladders');
        Schema::dropIfExists('entity__master_schools');
        Schema::dropIfExists('entity__master_subjects');
    }
}
