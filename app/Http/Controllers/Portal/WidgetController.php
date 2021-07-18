<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Portal\Extracurricular;
use App\Models\Portal\Facility;
use App\Models\Portal\Program;
use App\Models\Portal\Setting;
use App\Models\Portal\Slider;
use App\Models\Portal\Teacher;
use App\Models\Portal\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WidgetController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['setting'] = new Setting();
    }

    public function slider(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Slider::OrderBy('slider_status', 'DESC')->get() as $slider){
                    $data[] = [
                        $no++,
                        $slider->slider_title,
                        $slider->slider_content,
                        '<img src="'.asset('storage/portal/images/slider/'.$slider->slider_image).'" style="width: 120px"/>',
                        $slider->slider_status == 1 ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Tdk Aktif</span>',
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'. $slider->slider_id .'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="' . $slider->slider_id . '"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'slider'){
                $msg = Slider::where('slider_id', $request->slider_id)->first();
            }
            elseif ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(), [
                        'slider_title' => 'required',
                        'slider_image' => 'required|mimes:jpg,jpeg,png|max:512'
                    ], [
                        'slider_title.required' => 'Kolom judul tidak boleh kosong.',
                        'slider_image.max' => 'Ukuran gambar maksimal 512Kb',
                        'mslider_image.mimes' => 'format gambar harus jpg/jpeg/png',
                        'slider_image.required' => 'Gambar slider kosong, silahkan pilih gambar.'
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $request->hasFile('slider_image');
                        $file = $request->file('slider_image');
                        $file->store('public/portal/images/slider');
                        $slider = new Slider();
                        $slider->slider_image          = $file->hashName();
                        $slider->slider_title          = $request->slider_title;
                        $slider->slider_content        = $request->slider_content;
                        $slider->slider_button_link_1  = $request->slider_button_link_1;
                        $slider->slider_button_name_1  = $request->slider_button_name_1;
                        $slider->slider_button_link_2  = $request->slider_button_link_2;
                        $slider->slider_button_name_2  = $request->slider_button_name_2;
                        $slider->slider_status     = $request->slider_status;
                        if ( $slider->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Slider berhasil disimpan.'];
                        }
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(), [
                        'slider_title' => 'required',
                        'slider_image' => 'mimes:jpg,jpeg,png|max:512'
                    ], [
                        'slider_title.required' => 'Kolom judul tidak boleh kosong.',
                        'slider_image.max' => 'Ukuran gambar maksimal 512Kb',
                        'mslider_image.mimes' => 'format gambar harus jpg/jpeg/png',
                        'slider_image.required' => 'Gambar slider kosong, silahkan pilih gambar.'
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $slider = Slider::find($request->slider_id);
                        if ($request->hasFile('slider_image')){
                            $file = $request->file('slider_image');
                            Storage::delete('public/portal/images/slider/'. $slider->slider_image);
                            $file->store('public/portal/images/slider');
                            $slider->slider_image          = $file->hashName();
                        }
                        $slider->slider_title          = $request->slider_title;
                        $slider->slider_content        = $request->slider_content;
                        $slider->slider_button_link_1  = $request->slider_button_link_1;
                        $slider->slider_button_name_1  = $request->slider_button_name_1;
                        $slider->slider_button_link_2  = $request->slider_button_link_2;
                        $slider->slider_button_name_2  = $request->slider_button_name_2;
                        $slider->slider_status     = $request->slider_status;
                        if ( $slider->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Slider berhasil diperbarui.'];
                        }
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $slider = Slider::find($request->slider_id);
                    if ($slider->delete()){
                        Storage::delete('public/portal/images/slider/'. $slider->slider_image);
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Slider berhasil dihapus.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('portal.backend.widget_slider', $this->data);
        }
    }

    public function program(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Program::OrderBy('program_name', 'ASC')->get() as $program){
                    $data[] = [
                        $no++,
                        $program->program_name,
                        $program->program_desc,
                        '<img src="'.asset('storage/portal/images/program/'. $program->program_image).'" style="width: 64"/>',
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'. $program->program_id .'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="' . $program->program_id . '"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'program'){
                $msg = Program::where('program_id', $request->program_id)->first();
            }
            elseif ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(), [
                        'program_name' => 'required',
                        'program_image' => 'required|mimes:jpg,jpeg,png|max:512'
                    ], [
                        'program_name.required' => 'Kolom nama program tidak boleh kosong.',
                        'program_image.required' => 'Gambar program tidak boleh kosong.',
                        'program_image.mimes' => 'Gambar harus berformat jpg/jpeg/png.',
                        'program_image.max' => 'Ukuran maksimal gambar 512Kb.',
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $request->hasFile('program_image');
                        $file = $request->file('program_image');
                        $file->store('public/portal/images/program/');
                        $program = new Program();
                        $program->program_image = $file->hashName();
                        $program->program_name  = $request->program_name;
                        $program->program_desc  = $request->program_desc;
                        $program->program_link  = $request->program_link;
                        if ( $program->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Program berhasil disimpan.'];
                        }
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(), [
                        'program_name' => 'required',
                        'program_image' => 'mimes:jpg,jpeg,png|max:512'
                    ], [
                        'program_name.required' => 'Kolom nama program tidak boleh kosong.',
                        'program_image.mimes' => 'Gambar harus berformat jpg/jpeg/png.',
                        'program_image.max' => 'Ukuran maksimal gambar 512Kb.',
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $program = Program::find($request->program_id);
                        if ($request->hasFile('program_image')){
                            $file = $request->file('program_image');
                            Storage::delete('public/portal/images/program/'. $program->program_image);
                            $file->store('public/portal/images/program/');
                            $program->program_image = $file->hashName();
                        }
                        $program->program_name  = $request->program_name;
                        $program->program_desc  = $request->program_desc;
                        $program->program_link  = $request->program_link;
                        if ( $program->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Program berhasil diperbarui.'];
                        }
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $program = Program::find($request->program_id);
                    if ($program->delete()){
                        Storage::delete('public/portal/images/program/'. $program->program_image);
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Program berhasil dihapus.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('portal.backend.widget_program', $this->data);
        }
    }

    public function extracurricular(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Extracurricular::OrderBy('extracurricular_name', 'ASC')->get() as $extracurricular){
                    $data[] = [
                        $no++,
                        $extracurricular->extracurricular_name,
                        $extracurricular->extracurricular_desc,
                        '<img src="'.asset('storage/portal/images/extracurricular/'. $extracurricular->extracurricular_image).'" style="width: 100px"/>',
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'. $extracurricular->extracurricular_id .'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="' . $extracurricular->extracurricular_id . '"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'extracurricular'){
                $msg = Extracurricular::find($request->extracurricular_id);
            }
            elseif ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(), [
                        'extracurricular_name' => 'required',
                        'extracurricular_desc' => 'required',
                        'extracurricular_teacher' => 'required',
                        'extracurricular_category' => 'required',
                        'extracurricular_day' => 'required',
                        'extracurricular_time' => 'required',
                        'extracurricular_review' => 'required',
                        'extracurricular_student' => 'required',
                        'extracurricular_image' => 'required|mimes:jpg,jpeg,png|max:512'
                    ], [
                        'extracurricular_name.required' => 'Kolom nama ekstrakurikuler tidak boleh kosong.',
                        'extracurricular_desc.required' => 'Kolom diskrisi ekstrakurikuler tidak boleh kosong.',
                        'extracurricular_teacher.required' => 'Kolom pelatih ekstrakurikuler tidak boleh kosong.',
                        'extracurricular_category.required' => 'Kolom kategori ekstrakurikuler tidak boleh kosong.',
                        'extracurricular_day.required' => 'Kolom hari ekstrakurikuler tidak boleh kosong.',
                        'extracurricular_time.required' => 'Kolom waktu ekstrakurikuler tidak boleh kosong.',
                        'extracurricular_review.required' => 'Kolom Rating tidak boleh kosong.',
                        'extracurricular_student.required' => 'Kolom Peserta tidak boleh kosong.',
                        'extracurricular_images.required' => 'Gambar ekstrakurikuler tidak boleh kosong.',
                        'extracurricular_image.mimes' => 'Gambar harus berformat jp/jpeg/png.',
                        'extracurricular_image.max' => 'Ukuran gambar maksimal 512Kb.'
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $request->hasFile('extracurricular_image');
                        $file = $request->file('extracurricular_image');
                        $file->store('public/portal/images/extracurricular/');
                        $extracurricular = new Extracurricular();
                        $extracurricular->extracurricular_name  = $request->extracurricular_name;
                        $extracurricular->extracurricular_desc  = $request->extracurricular_desc;
                        $extracurricular->extracurricular_teacher  = $request->extracurricular_teacher;
                        $extracurricular->extracurricular_category  = $request->extracurricular_category;
                        $extracurricular->extracurricular_day  = $request->extracurricular_day;
                        $extracurricular->extracurricular_time  = $request->extracurricular_time;
                        $extracurricular->extracurricular_review  = $request->extracurricular_review;
                        $extracurricular->extracurricular_student  = $request->extracurricular_student;
                        $extracurricular->extracurricular_image = $file->hashName();
                        if ( $extracurricular->save()){
                            $msg = ['status' => 'success', 'title' => 'Berhasil !', 'class' => 'success', 'text' => 'Data Ekstrakurikuler berhasil disimpan.'];
                        }
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(), [
                        'extracurricular_name' => 'required',
                        'extracurricular_desc' => 'required',
                        'extracurricular_teacher' => 'required',
                        'extracurricular_category' => 'required',
                        'extracurricular_day' => 'required',
                        'extracurricular_time' => 'required',
                        'extracurricular_review' => 'required',
                        'extracurricular_student' => 'required',
                    ], [
                        'extracurricular_name.required' => 'Kolom nama ekstrakurikuler tidak boleh kosong.',
                        'extracurricular_desc.required' => 'Kolom diskrisi ekstrakurikuler tidak boleh kosong.',
                        'extracurricular_teacher.required' => 'Kolom pelatih ekstrakurikuler tidak boleh kosong.',
                        'extracurricular_category.required' => 'Kolom kategori ekstrakurikuler tidak boleh kosong.',
                        'extracurricular_day.required' => 'Kolom hari ekstrakurikuler tidak boleh kosong.',
                        'extracurricular_time.required' => 'Kolom waktu ekstrakurikuler tidak boleh kosong.',
                        'extracurricular_review.required' => 'Kolom Rating tidak boleh kosong.',
                        'extracurricular_student.required' => 'Kolom Peserta tidak boleh kosong.',
                        'extracurricular_images.required' => 'Gambar ekstrakurikuler tidak boleh kosong.',
                        'extracurricular_image.mimes' => 'Gambar harus berformat jp/jpeg/png.',
                        'extracurricular_image.max' => 'Ukuran gambar maksimal 512Kb.'
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $extracurricular = Extracurricular::find($request->extracurricular_id);
                        if ($request->hasFile('extracurricular_image')){
                            $file = $request->file('extracurricular_image');
                            Storage::delete('public/portal/images/extracurricular/'. $extracurricular->extracurricular_image);
                            $file->store('public/portal/images/extracurricular/');
                            $extracurricular->extracurricular_image = $file->hashName();
                        }
                        $extracurricular->extracurricular_name  = $request->extracurricular_name;
                        $extracurricular->extracurricular_desc  = $request->extracurricular_desc;
                        $extracurricular->extracurricular_teacher  = $request->extracurricular_teacher;
                        $extracurricular->extracurricular_category  = $request->extracurricular_category;
                        $extracurricular->extracurricular_day  = $request->extracurricular_day;
                        $extracurricular->extracurricular_time  = $request->extracurricular_time;
                        $extracurricular->extracurricular_review  = $request->extracurricular_review;
                        $extracurricular->extracurricular_student  = $request->extracurricular_student;
                        if ( $extracurricular->save()){
                            $msg = ['status' => 'success', 'title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Ekstrakurikuler berhasil diperbarui.'];
                        }
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $extracurricular = Extracurricular::find($request->extracurricular_id);
                    if ($extracurricular->delete()){
                        Storage::delete('public/portal/fronted/images/extracurricular/'. $extracurricular->extracurricular_image);
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Program berhasil dihapus.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('portal.backend.widget_extracurricular', $this->data);
        }
    }

    public function teacher(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Teacher::OrderBy('teacher_name', 'ASC')->get() as $teacher){
                    $data[] = [
                        $no++,
                        $teacher->teacher_name,
                        $teacher->teacher_job,
                        '<img src="'.asset($teacher->teacher_image == null ? 'assets/apps/portal/images/blog-1.jpg' : 'storage/portal/images/teacher/'. $teacher->teacher_image).'" style="width: 100px"/>',
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'. $teacher->teacher_id .'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="' . $teacher->teacher_id . '"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'teacher'){
                $msg = Teacher::find($request->teacher_id);
            }
            elseif ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(), [
                        'teacher_name' => 'required',
                        'teacher_job' => 'required',
                        'teacher_about' => 'required',
                        'teacher_image' => 'mimes:jpg,jpeg,png|max:512'
                    ], [
                        'teacher_name.required' => 'Kolom nama guru tidak boleh kosong.',
                        'teacher_job.required' => 'Kolom jabatan guru tidak boleh kosong.',
                        'teacher_about.required' => 'Kolom Tentang guru tidak boleh kosong.',
                        'teacher_image.mimes' => 'Gambar harus berformat jp/jpeg/png.',
                        'teacher_image.max' => 'Ukuran gambar maksimal 512Kb.'
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $teacher = new Teacher();
                        if ($request->hasFile('teacher_image')){
                            $file = $request->file('teacher_image');
                            $file->store('public/portal/images/teacher/');
                            $teacher->teacher_image = $file->hashName();
                        }
                        $teacher->teacher_name  = $request->teacher_name;
                        $teacher->teacher_job  = $request->teacher_job;
                        $teacher->teacher_mail  = $request->teacher_mail;
                        $teacher->teacher_facebook  = $request->teacher_facebook;
                        $teacher->teacher_twitter  = $request->teacher_twitter;
                        $teacher->teacher_instagram  = $request->teacher_instagram;
                        $teacher->teacher_about  = $request->teacher_about;
                        $teacher->teacher_achievement  = $request->teacher_achievement;
                        if ( $teacher->save()){
                            $msg = ['status' => 'success', 'title' => 'Berhasil !', 'class' => 'success', 'text' => 'Data Guru berhasil disimpan.'];
                        }
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(), [
                        'teacher_name' => 'required',
                        'teacher_job' => 'required',
                        'teacher_about' => 'required',
                        'teacher_image' => 'mimes:jpg,jpeg,png|max:512'
                    ], [
                        'teacher_name.required' => 'Kolom nama guru tidak boleh kosong.',
                        'teacher_job.required' => 'Kolom jabatan guru tidak boleh kosong.',
                        'teacher_about.required' => 'Kolom Tentang guru tidak boleh kosong.',
                        'teacher_image.mimes' => 'Gambar harus berformat jp/jpeg/png.',
                        'teacher_image.max' => 'Ukuran gambar maksimal 512Kb.'
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $teacher = Teacher::find($request->teacher_id);
                        if ($request->hasFile('teacher_image')){
                            $file = $request->file('teacher_image');
                            Storage::delete('public/portal/images/teacher/'. $teacher->teacher_image);
                            $file->store('public/portal/images/teacher/');
                            $teacher->teacher_image = $file->hashName();
                        }
                        $teacher->teacher_name  = $request->teacher_name;
                        $teacher->teacher_job  = $request->teacher_job;
                        $teacher->teacher_mail  = $request->teacher_mail;
                        $teacher->teacher_facebook  = $request->teacher_facebook;
                        $teacher->teacher_twitter  = $request->teacher_twitter;
                        $teacher->teacher_instagram  = $request->teacher_instagram;
                        $teacher->teacher_about  = $request->teacher_about;
                        $teacher->teacher_achievement  = $request->teacher_achievement;
                        if ( $teacher->save()){
                            $msg = ['status' => 'success', 'title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Guru berhasil diperbarui.'];
                        }
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $teacher = Teacher::find($request->teacher_id);
                    if ($teacher->delete()){
                        Storage::delete('public/portal/images/teacher/'. $teacher->teacher_image);
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Guru berhasil dihapus.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('portal.backend.widget_teacher', $this->data);
        }
    }

    public function facility(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Facility::OrderBy('facility_name', 'ASC')->get() as $facility){
                    $data[] = [
                        $no++,
                        $facility->facility_name,
                        $facility->facility_desc,
                        '<img src="'.asset($facility->facility_image == null ? 'assets/apps/portal/images/blog-1.jpg' : 'storage/portal/images/facility/'. $facility->facility_image).'" style="width: 100px"/>',
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'. $facility->facility_id .'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="' . $facility->facility_id . '"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'facility'){
                $msg = Facility::find($request->facility_id);
            }
            elseif ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(), [
                        'facility_name' => 'required',
                        'facility_image' => 'mimes:jpg,jpeg,png|max:512'
                    ], [
                        'facility_name.required' => 'Kolom nama fasilitas tidak boleh kosong.',
                        'facility_image.mimes' => 'Gambar harus berformat jp/jpeg/png.',
                        'facility_image.max' => 'Ukuran gambar maksimal 512Kb.'
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $facility = new Facility();
                        if ($request->hasFile('facility_image')){
                            $file = $request->file('facility_image');
                            $file->store('public/portal/images/facility/');
                            $facility->facility_image = $file->hashName();
                        }
                        $facility->facility_name  = $request->facility_name;
                        $facility->facility_desc  = $request->facility_desc;
                        $facility->facility_link  = $request->facility_link;
                        if ( $facility->save()){
                            $msg = ['title' => 'Berhasil !', 'class' => 'success', 'text' => 'Data Fasilitas berhasil disimpan.'];
                        }
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(), [
                        'facility_name' => 'required',
                        'facility_image' => 'mimes:jpg,jpeg,png|max:512'
                    ], [
                        'facility_name.required' => 'Kolom nama fasilitas tidak boleh kosong.',
                        'facility_image.mimes' => 'Gambar harus berformat jp/jpeg/png.',
                        'facility_image.max' => 'Ukuran gambar maksimal 512Kb.'
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $facility = Facility::find($request->facility_id);
                        if ($request->hasFile('facility_image')){
                            $file = $request->file('facility_image');
                            Storage::delete('public/portal/images/facility/'. $facility->facility_image);
                            $file->store('public/portal/images/facility/');
                            $facility->facility_image = $file->hashName();
                        }
                        $facility->facility_name  = $request->facility_name;
                        $facility->facility_desc  = $request->facility_desc;
                        $facility->facility_link  = $request->facility_link;
                        if ( $facility->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Fasilitas berhasil diperbarui.'];
                        }
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $facility = Facility::find($request->facility_id);
                    if ($facility->delete()){
                        Storage::delete('public/portal/images/facility/'. $facility->facility_image);
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Fasilitas berhasil dihapus.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('portal.backend.widget_facility', $this->data);
        }
    }

    public function testimonial(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Testimonial::OrderBy('testimonial_name', 'ASC')->get() as $testimonial){
                    $data[] = [
                        $no++,
                        $testimonial->testimonial_name,
                        $testimonial->testimonial_job,
                        $testimonial->testimonial_desc,
                        '<img src="'.asset('storage/portal/images/testimonial/'. $testimonial->testimonial_image).'" style="width: 100px"/>',
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'. $testimonial->testimonial_id .'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="' . $testimonial->testimonial_id . '"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'testimonial'){
                $msg = Testimonial::find($request->testimonial_id);
            }
            elseif ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(), [
                        'testimonial_name' => 'required',
                        'testimonial_job' => 'required',
                        'testimonial_desc' => 'required',
                        'testimonial_image' => 'mimes:jpg,jpeg,png|max:512'
                    ], [
                        'testimonial_name.required' => 'Kolom nama tidak boleh kosong.',
                        'testimonial_job.required' => 'Kolom jabatan tidak boleh kosong.',
                        'testimonial_desc.required' => 'Kolom diskripsi tidak boleh kosong.',
                        'testimonial_image.mimes' => 'Gambar harus berformat jp/jpeg/png.',
                        'testimonial_image.max' => 'Ukuran gambar maksimal 512Kb.'
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $testimonial = new Testimonial();
                        if ($file = $request->file('testimonial_image')){
                            $file->store('public/portal/images/testimonial/');
                            $testimonial->testimonial_image = $file->hashName();
                        }
                        $testimonial->testimonial_name  = $request->testimonial_name;
                        $testimonial->testimonial_job  = $request->testimonial_job;
                        $testimonial->testimonial_desc  = $request->testimonial_desc;
                        if ( $testimonial->save()){
                            $msg = ['title' => 'Berhasil !', 'class' => 'success', 'text' => 'Data Testimoni berhasil disimpan.'];
                        }
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(), [
                        'testimonial_name' => 'required',
                        'testimonial_job' => 'required',
                        'testimonial_desc' => 'required',
                        'testimonial_image' => 'mimes:jpg,jpeg,png|max:512'
                    ], [
                        'testimonial_name.required' => 'Kolom nama tidak boleh kosong.',
                        'testimonial_job.required' => 'Kolom jabatan tidak boleh kosong.',
                        'testimonial_desc.required' => 'Kolom diskripsi tidak boleh kosong.',
                        'testimonial_image.mimes' => 'Gambar harus berformat jp/jpeg/png.',
                        'testimonial_image.max' => 'Ukuran gambar maksimal 512Kb.'
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $testimonial = Testimonial::find($request->testimonial_id);
                        if ($request->hasFile('testimonial_image')){
                            $file = $request->file('testimonial_image');
                            Storage::delete('public/portal/images/testimonial/'. $testimonial->testimonial_image);
                            $file->store('public/portal/images/testimonial/');
                            $testimonial->testimonial_image = $file->hashName();
                        }
                        $testimonial->testimonial_name  = $request->testimonial_name;
                        $testimonial->testimonial_job  = $request->testimonial_job;
                        $testimonial->testimonial_desc  = $request->testimonial_desc;
                        if ( $testimonial->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Testimoni berhasil diperbarui.'];
                        }
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $testimonial = Extracurricular::find($request->testimonial_id);
                    if ($testimonial->delete()){
                        Storage::delete('public/portal/images/testimonial/'. $testimonial->testimonial_image);
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Testimoni berhasil dihapus.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('portal.backend.widget_testimonial', $this->data);
        }
    }
}
