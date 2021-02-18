<?php

namespace Database\Seeders;

use App\Models\Portal\Comment;
use App\Models\Portal\Event;
use App\Models\Portal\Extracurricular;
use App\Models\Portal\Facility;
use App\Models\Portal\Post;
use App\Models\Portal\Program;
use App\Models\Portal\Role;
use App\Models\Portal\Slider;
use App\Models\Portal\Tag;
use App\Models\Portal\Testimonial;
use App\Models\Portal\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::factory(10)->create();
        $post = Post::factory(30)->create();
        Slider::factory(10)->create();
        Program::factory(4)->create();
        Extracurricular::factory(7)->create();
        Facility::factory(10)->create();
        Testimonial::factory(5)->create();
        Tag::factory(10)->create();
        Role::factory(2)->create();
        User::factory(2)->create();
        Comment::factory(20)->create();

        $post->each(function ($post){
            $post->tag()->attach(['post_id' => $post->post_id], ['tag_id' => 10]);
            $post->comment()->attach(['post_id' => $post->post_id], ['comment_id' => 8]);
        });


        $section = [
            ['home_section_program', '1'],
            ['home_section_about_name',  'Tentang Kami'],
            ['home_section_about_title',  'MTs. Darul Hikmah Menganti'],
            ['home_section_about_content',  Factory::create('id')->sentence(50)],
            ['home_section_about_link',  '#'],
            ['home_section_about_button',  'Selengkapnya'],
            ['home_section_about_image', 'storage/portal/fronted/images/home-bg-1.png'],
            ['home_section_yt_background', 'storage/portal/fronted/images/bg-1.jpg'],
            ['home_section_yt_youtube', 'https://www.youtube.com/watch?v=q7z2Ww2a_PA'],
            ['home_section_4_icon_1', 'storage/portal/fronted/images/icons/f-1.png'],
            ['home_section_4_title_1', 'Bimbingan Keimanan & Pengalaman Keislaman'],
            ['home_section_4_content_1', 'Menyelenggarakan bimbingan keimanan dan pengamalan keislaman yang rahmatan lil`alamin.'],
            ['home_section_4_icon_2', 'storage/portal/fronted/images/icons/f-1.png'],
            ['home_section_4_title_2', 'Bimbingan dan Pembelajaran yang Profesional'],
            ['home_section_4_content_2', 'Menyelenggarakan bimbingan dan pembelajaran yang profesional, inovatif, dan kompetitif .'],
            ['home_section_4_icon_3', 'storage/portal/fronted/images/icons/f-1.png'],
            ['home_section_4_title_3', 'Kegiatan Non Akademik'],
            ['home_section_4_content_3', 'Menyelenggarakan kegiatan nonakademik berbasis kompetensi dan prestasi.'],
            ['home_section_testi_bg', 'storage/portal/fronted/image/bg-2.jpg'],
            ['article_section_title_bg', 'storage/portal/fronted/images/page-banner-4.jpg']
        ];

        for ($i=0;$i<count($section);$i++){
            DB::table('portal_entity__sections')->insert([
                'section_name' => $section[$i][0],
                'section_content' => $section[$i][1]
            ]);
        }

        $category = [
            ['Profil',  ''],
            ['Artikel', ''],
            ['Ekstrakurikuler', '']
        ];

        for ($i=0;$i<count($category);$i++){
            DB::table('portal_entity__categories')->insert([
                'category_name' => $category[$i][0],
                'category_desc' => $category[$i][1]
            ]);
        }

        $setting = [
            ['app_name', 'PORTAL RESMI'],
            ['school_logo', 'storage/portal/fronted/images/logo.png'],
            ['school_name', 'MTs. DARUL HIKMAH MENGANTI'],
            ['school_address', 'Jl. Bugel - Jepara KM 7'],
            ['school_village', 'Menganti'],
            ['school_subdistric', 'Kedung'],
            ['school_distric', 'Jepara'],
            ['school_province', 'Jawa Tengah'],
            ['school_operational ', 'Senin s/d Sabtu 07:00 - 14:00'],
            ['school_phone', '+62 8222 9366 506'],
            ['school_email', 'mts@darul-hikmah.sch.id'],
            ['header_logo', 'storage/portal/fronted/images/logo-2.png'],
            ['footer_logo', 'storage/portal/fronted/images/logo-2.png'],
            ['footer_desc', 'Website MTs Darul Hikmah Menganti Merupakan Media Informasi dan Komunikasi Guna Pelayanan yang Lebih Optimal.'],

        ];

        for ($i=0;$i<count($setting);$i++){
            DB::table('portal_entity__settings')->insert([
                'setting_name' => $setting[$i][0],
                'setting_value' => $setting[$i][1]
            ]);
        }
    }
}
