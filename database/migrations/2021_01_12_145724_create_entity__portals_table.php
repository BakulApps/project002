<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityPortalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portal_entity__sliders', function (Blueprint $table) {
            $table->id('slider_id');
            $table->string('slider_title',100)->nullable();
            $table->mediumText('slider_content')->nullable();
            $table->string('slider_button_link_1', 100)->nullable();
            $table->string('slider_button_name_1', 50)->nullable();
            $table->string('slider_button_link_2', 100)->nullable();
            $table->string('slider_button_name_2', 50)->nullable();
            $table->string('slider_image')->nullable();
            $table->boolean('slider_status')->default(0)->nullable();
        });

        Schema::create('portal_entity__programs', function (Blueprint $table) {
            $table->id('program_id');
            $table->string('program_name',100)->nullable();
            $table->mediumText('program_desc')->nullable();
            $table->string('program_link')->nullable();
            $table->string('program_image');
        });

        Schema::create('portal_entity__teachers', function (Blueprint $table){
            $table->id('teacher_id');
            $table->string('teacher_name', 100)->nullable();
            $table->string('teacher_job', 100)->nullable();
            $table->string('teacher_mail', 200)->nullable();
            $table->string('teacher_facebook', 200)->nullable();
            $table->string('teacher_twitter', 200)->nullable();
            $table->string('teacher_instagram', 200)->nullable();
            $table->string('teacher_about', 200)->nullable();
            $table->string('teacher_achievement', 200)->nullable();
            $table->string('teacher_desc', 200)->nullable();
            $table->string('teacher_image')->nullable();
        });

        Schema::create('portal_entity__extracurriculars', function (Blueprint $table) {
            $table->id('extracurricular_id');
            $table->string('extracurricular_name',100);
            $table->text('extracurricular_desc')->nullable();
            $table->string('extracurricular_teacher')->nullable();
            $table->string('extracurricular_category')->nullable();
            $table->string('extracurricular_review')->nullable();
            $table->string('extracurricular_day')->nullable();
            $table->string('extracurricular_time')->nullable();
            $table->string('extracurricular_student')->nullable();
            $table->string('extracurricular_image')->nullable();
        });

        Schema::create('portal_entity__facilities', function (Blueprint $table) {
            $table->id('facility_id');
            $table->string('facility_name',100)->nullable();
            $table->mediumText('facility_desc')->nullable();
            $table->string('facility_link')->nullable();
            $table->string('facility_image')->nullable();
        });

        Schema::create('portal_entity__testimonials', function (Blueprint $table) {
            $table->id('testimonial_id');
            $table->string('testimonial_name',100);
            $table->string('testimonial_job');
            $table->mediumText('testimonial_desc')->nullable();
            $table->string('testimonial_image')->nullable();
        });

        Schema::create('portal_entity__sections', function (Blueprint $table) {
            $table->id('section_id');
            $table->string('section_name', 100)->nullable();
            $table->mediumText('section_content')->nullable();
        });

        Schema::create('portal_entity__events', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('event_image', 100)->nullable();
            $table->string('event_title', 100)->nullable();
            $table->mediumText('event_content')->nullable();
            $table->string('event_place', 100)->nullable();
            $table->date('event_date_start')->nullable();
            $table->date('event_date_end')->nullable();
            $table->string('event_galery')->nullable();
        });

        Schema::create('portal_entity__posts', function (Blueprint $table) {
            $table->id('post_id');
            $table->string('post_image')->nullable();
            $table->integer('post_author')->nullable();
            $table->integer('post_category')->nullable();
            $table->string('post_title')->nullable();
            $table->text('post_content')->nullable();
            $table->boolean('post_comment')->default(0)->nullable();
            $table->boolean('post_status')->default(0)->nullable();
            $table->integer('post_read')->nullable();
            $table->timestamps();
        });

        Schema::create('portal_entity__categories', function (Blueprint $table) {
            $table->id('category_id');
            $table->string('category_name', 100);
            $table->mediumText('category_desc')->nullable();
        });

        Schema::create('portal_entity__tags', function (Blueprint $table) {
            $table->id('tag_id');
            $table->string('tag_name', 20);
            $table->mediumText('tag_desc')->nullable();
        });

        Schema::create('portal_entity__comments', function (Blueprint $table) {
            $table->id('comment_id');
            $table->integer('comment_parent')->nullable();
            $table->string('comment_name', 50);
            $table->string('comment_email', 50)->nullable();
            $table->mediumText('comment_content');
            $table->boolean('comment_read');
            $table->timestamps();
        });

        Schema::create('portal_entity__posts_tag', function (Blueprint $table) {
            $table->id('post_tag_id');
            $table->integer('post_id');
            $table->integer('tag_id');
        });

        Schema::create('portal_entity__posts_comment', function (Blueprint $table){
            $table->id('post_comment_id');
            $table->integer('post_id');
            $table->integer('comment_id');
        });

        Schema::create('portal_entity__settings', function (Blueprint $table) {
            $table->id('setting_id');
            $table->string('setting_name')->unique();
            $table->string('setting_value');
        });

        Schema::create('portal_entity__users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('user_image')->nullable();
            $table->string('user_fullname', 200);
            $table->string('user_name', 50);
            $table->string('user_pass');
            $table->string('user_email', 50);
            $table->string('user_role');
            $table->mediumText('user_desc')->nullable();
            $table->string('user_facebook')->nullable();
            $table->string('user_instagram')->nullable();
            $table->string('user_twitter')->nullable();
            $table->rememberToken();
        });

        Schema::create('portal_entity__roles', function (Blueprint $table) {
            $table->id('role_id');
            $table->string('role_name', 20);
            $table->mediumText('role_desc')->nullable();
        });

        Schema::create('portal_entity__menus', function (Blueprint $table){
            $table->id('menu_id');
            $table->string('menu_parent', 3)->default(0)->nullable();
            $table->string('menu_name', 100)->nullable();
            $table->string('menu_link', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portal_entity__sliders');
        Schema::dropIfExists('portal_entity__programs');
        Schema::dropIfExists('portal_entity__extracurriculars');
        Schema::dropIfExists('portal_entity__facilities');
        Schema::dropIfExists('portal_entity__sections');
        Schema::dropIfExists('portal_entity__events');
        Schema::dropIfExists('portal_entity__testimonials');
        Schema::dropIfExists('portal_entity__posts');
        Schema::dropIfExists('portal_entity__categories');
        Schema::dropIfExists('portal_entity__tags');
        Schema::dropIfExists('portal_entity__comments');
        Schema::dropIfExists('portal_entity__posts_tag');
        Schema::dropIfExists('portal_entity__posts_comment');
        Schema::dropIfExists('portal_entity__settings');
        Schema::dropIfExists('portal_entity__users');
        Schema::dropIfExists('portal_entity__roles');
        Schema::dropIfExists('portal_entity__teachers');
        Schema::dropIfExists('portal_entity__menus');
    }
}
