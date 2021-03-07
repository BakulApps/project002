<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_entity__schools_from', function (Blueprint $table) {
            $table->integer('from_id');
            $table->string('from_name', 50);
            $table->string('from_category', 10);
        });

        Schema::create('student_entity__schools_kind', function (Blueprint $table) {
            $table->integer('kind_id');
            $table->string('kind_name', 50);
            $table->string('kind_category', 10);
        });

        Schema::create('student_entity__contests_field', function (Blueprint $table) {
            $table->integer('field_id');
            $table->string('field_name', 20);
        });

        Schema::create('student_entity__contests_category', function (Blueprint $table) {
            $table->integer('category_id');
            $table->string('category_name', 20);
        });

        Schema::create('student_entity__contests_achievement', function (Blueprint $table) {
            $table->integer('achievement_id');
            $table->string('achievement_name', 50);
        });

        Schema::create('student_entity__contests_level', function (Blueprint $table) {
            $table->integer('level_id');
            $table->string('level_name', 50);
        });

        Schema::create('student_entity__purposes', function (Blueprint $table) {
            $table->integer('purpose_id');
            $table->string('purpose_name', 20);
        });

        Schema::create('student_entity__hobbies', function (Blueprint $table) {
            $table->integer('hobby_id');
            $table->string('hobby_name', 20);
        });

        Schema::create('student_entity__scholarships', function (Blueprint $table) {
            $table->integer('scholarship_id');
            $table->string('scholarship_name', 20);
        });

        Schema::create('student_entity__scholarships_source', function (Blueprint $table) {
            $table->integer('source_id');
            $table->string('source_name', 20);
        });

        Schema::create('student_entity__residences', function (Blueprint $table) {
            $table->integer('residence_id');
            $table->string('residence_name', 50);
        });


        Schema::create('student_entity__status', function (Blueprint $table) {
            $table->integer('status_id');
            $table->string('status_name', 20);
        });

        Schema::create('student_entity__status_active', function (Blueprint $table) {
            $table->integer('active_id');
            $table->string('active_name', 20);
        });

        Schema::create('student_entity__status_out', function (Blueprint $table) {
            $table->integer('out_id');
            $table->string('out_name', 20);
        });

        Schema::create('student_entity__levels', function (Blueprint $table) {
            $table->integer('level_id');
            $table->string('level_name', 20);
        });

        Schema::create('student_entity__programs', function (Blueprint $table) {
            $table->integer('program_id');
            $table->string('program_name', 50);
        });

        Schema::create('student_entity__parents_status', function (Blueprint $table) {
            $table->integer('status_id');
            $table->string('status_name', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_entity__schools_from');
        Schema::dropIfExists('student_entity__schools_kind');
        Schema::dropIfExists('student_entity__contests_field');
        Schema::dropIfExists('student_entity__contests_category');
        Schema::dropIfExists('student_entity__contests_achievement');
        Schema::dropIfExists('student_entity__contests_level');
        Schema::dropIfExists('student_entity__purposes');
        Schema::dropIfExists('student_entity__hobbies');
        Schema::dropIfExists('student_entity__scholarships');
        Schema::dropIfExists('student_entity__scholarships_source');
        Schema::dropIfExists('student_entity__residences');
        Schema::dropIfExists('student_entity__status');
        Schema::dropIfExists('student_entity__status_active');
        Schema::dropIfExists('student_entity__status_out');
        Schema::dropIfExists('student_entity__levels');
        Schema::dropIfExists('student_entity__programs');
        Schema::dropIfExists('student_entity__parents_status');
    }
}
