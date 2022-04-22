<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityGraduateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graduate_entity__students', function (Blueprint $table) {
            $table->id('student_id');
            $table->string('student_name', 200);
            $table->string('student_nisn', 10)->unique();
            $table->string('student_nism', 20);
            $table->string('student_class', 10);
            $table->string('student_place_birth', 100)->nullable();
            $table->date('student_birthday')->nullable();
            $table->enum('student_gender', ['L', 'P'])->nullable();
            $table->string('student_address',200)->nullable();
            $table->string('student_father', 200)->nullable();
            $table->string('student_mother', 200)->nullable();
            $table->string('student_number_exam', 50)->nullable();
        });

        Schema::create('graduate_entity__values', function (Blueprint $table) {
            $table->id('value_id');
            $table->integer('value_point');
            $table->integer('value_subject');
        });

        Schema::create('graduate_entity__student_value', function (Blueprint $table){
            $table->id('student_value_id');
            $table->integer('student_id');
            $table->integer('value_id');
        });

        Schema::create('graduate_entity__announcement', function (Blueprint $table) {
            $table->id('announcement_id');
            $table->string('announcement_uuid');
            $table->string('announcement_number');
            $table->string('announcement_value_total');
            $table->string('announcement_status');
            $table->string('announcement_view');
            $table->string('announcement_print');
            $table->string('announcement_finance');
            $table->string('announcement_student');
        });

        Schema::create('graduate_entity__settings', function (Blueprint $table) {
            $table->id('setting_id');
            $table->string('setting_name',50);
            $table->string('setting_value')->nullable();
        });

        Schema::create('graduate_entity__users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('user_name');
            $table->string('user_pass');
            $table->string('user_fullname');
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
        Schema::dropIfExists('graduate_entity__students');
        Schema::dropIfExists('graduate_entity__values');
        Schema::dropIfExists('graduate_entity__student_value');
        Schema::dropIfExists('graduate_entity__announcement');
        Schema::dropIfExists('graduate_entity__settings');
        Schema::dropIfExists('graduate_entity__users');
    }
}
