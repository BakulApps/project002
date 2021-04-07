<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_entity__students', function (Blueprint $table) {
            $table->id('student_id');
            $table->string('student_name', 200);
            $table->string('student_number', 14);
            $table->integer('student_class');
            $table->string('student_username', 10);
            $table->string('student_password');
        });

        Schema::create('exam_entity__subjects', function (Blueprint $table){
            $table->id('subject_id');
            $table->string('subject_code', 3);
            $table->string('subject_name', 100);
        });

        Schema::create('exam_entity__levels', function (Blueprint $table){
            $table->id('level_id');
            $table->string('level_name', 50);
        });

        Schema::create('exam_entity__majors', function (Blueprint $table){
            $table->id('major_id');
            $table->string('major_code', 3);
            $table->string('major_name', 50);
        });

        Schema::create('exam_entity__classes', function (Blueprint $table){
            $table->id('class_id');
            $table->integer('class_level');
            $table->integer('class_major');
            $table->string('class_code', 3);
            $table->string('class_name', 10);
        });

        Schema::create('exam_entity__schedules', function (Blueprint $table){
            $table->id('schedule_id');
            $table->integer('schedule_subject');
            $table->integer('schedule_level');
            $table->dateTime('schedule_start');
            $table->dateTime('schedule_end');
            $table->string('schedule_token', 5);
            $table->string('schedule_link');
        });

        Schema::create('exam_entity__settings', function (Blueprint $table){
            $table->id('setting_id');
            $table->string('setting_name');
            $table->string('setting_value');
        });

        Schema::create('exam_entity__users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('user_image')->nullable();
            $table->string('user_fullname', 200);
            $table->string('user_name', 50);
            $table->string('user_pass');
            $table->string('user_email', 50);
            $table->string('user_role');
            $table->mediumText('user_desc')->nullable();
            $table->rememberToken();
        });

        Schema::create('exam_entity__roles', function (Blueprint $table) {
            $table->id('role_id');
            $table->string('role_name', 20);
            $table->mediumText('role_desc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_entity__students');
        Schema::dropIfExists('exam_entity__subjects');
        Schema::dropIfExists('exam_entity__levels');
        Schema::dropIfExists('exam_entity__majors');
        Schema::dropIfExists('exam_entity__classes');
        Schema::dropIfExists('exam_entity__schedules');
        Schema::dropIfExists('exam_entity__settings');
        Schema::dropIfExists('exam_entity__users');
        Schema::dropIfExists('exam_entity__roles');

    }
}
