<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Portal\Extracurricular;
use App\Models\Portal\Program;
use App\Models\Portal\Setting;
use App\Models\Portal\Slider;
use Illuminate\Http\Request;
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
                        '<img src="'.asset('storage/portal/fronted/images/slider/'.$slider->slider_image).'" style="width: 120px"/>',
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
                $validator = Validator::make($request->all(), [
                    'slider_image' => 'mimes:jpg,jpeg,png|max:512|nullable'
                ]);
                if ($validator->fails()) {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => 'Berkas Harus Berekstensi jpg, jpeg, png dan Ukuran maksimal 512 Kb'];
                }
                try {
                    if ($request->hasFile('slider_image')){
                        $file = $request->file('slider_image');
                        $file->store('public/portal/fronted/images/slider');
                    }
                    $slider = new Slider();
                    $slider->slider_image          = isset($file) ? $file->hashName() : null;
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
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                $validator = Validator::make($request->all(), [
                    'slider_image' => 'mimes:jpg,jpeg,png|max:512|nullable'
                ]);
                if ($validator->fails()) {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => 'Berkas Harus Berekstensi jpg, jpeg, png dan Ukuran maksimal 512 Kb'];
                }
                try {
                    $slider = Slider::find($request->slider_id);
                    if ($request->hasFile('slider_image')){
                        $file = $request->file('slider_image');
                        $file->store('public/portal/fronted/images/slider');
                        Storage::delete('public/portal/fronted/images/slider/'. $slider->slider_image);
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
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $slider = Slider::find($request->slider_id);
                    if ($slider->delete()){
                        Storage::delete('public/portal/fronted/images/slider/'. $slider->slider_image);
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
                        '<img src="'.asset('storage/portal/fronted/images/program/'. $program->program_image).'" style="width: 64"/>',
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
                $validator = Validator::make($request->all(), [
                    'program_image' => 'mimes:jpg,jpeg,png|max:512|nullable'
                ]);
                if ($validator->fails()) {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => 'Berkas Harus Berekstensi jpg, jpeg, png dan Ukuran maksimal 512 Kb'];
                }
                try {
                    if ($request->hasFile('program_image')){
                        $file = $request->file('program_image');
                        $file->store('public/portal/fronted/images/program/');
                    }
                    $program = new Program();
                    $program->program_image = isset($file) ? $file->hashName() : null;
                    $program->program_name  = $request->program_name;
                    $program->program_desc  = $request->program_desc;
                    $program->program_link  = $request->program_link;
                    if ( $program->save()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Program berhasil disimpan.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                $validator = Validator::make($request->all(), [
                    'program_image' => 'mimes:jpg,jpeg,png|max:512|nullable'
                ]);
                if ($validator->fails()) {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => 'Berkas Harus Berekstensi jpg, jpeg, png dan Ukuran maksimal 512 Kb'];
                }
                try {
                    $program = Program::find($request->program_id);
                    if ($request->hasFile('program_image')){
                        $file = $request->file('program_image');
                        $file->store('public/portal/fronted/images/program/');
                        Storage::delete('public/portal/fronted/images/program/'. $program->program_image);
                        $program->program_image = $file->hashName();
                    }
                    $program->program_name  = $request->program_name;
                    $program->program_desc  = $request->program_desc;
                    $program->program_link  = $request->program_link;
                    if ( $program->save()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Program berhasil diperbarui.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $program = Program::find($request->program_id);
                    if ($program->delete()){
                        Storage::delete('public/portal/fronted/images/program/'. $program->program_image);
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
                        '<img src="'.asset('storage/portal/fronted/images/extracurricular/'. $extracurricular->extracurricular_image).'" style="width: 100px"/>',
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
                $validator = Validator::make($request->all(), [
                    'extracurricular_image' => 'mimes:jpg,jpeg,png|max:512|nullable'
                ]);
                if ($validator->fails()) {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => 'Berkas Harus Berekstensi jpg, jpeg, png dan Ukuran maksimal 512 Kb'];
                }
                try {
                    if ($request->hasFile('extracurricular_image')){
                        $file = $request->file('extracurricular_image');
                        $file->store('public/portal/fronted/images/extracurricular/');
                    }
                    $extracurricular = new Extracurricular();
                    $extracurricular->extracurricular_image = isset($file) ? $file->hashName() : null;
                    $extracurricular->extracurricular_name  = $request->extracurricular_name;
                    $extracurricular->extracurricular_desc  = $request->extracurricular_desc;
                    $extracurricular->extracurricular_link  = $request->extracurricular_link;
                    if ( $extracurricular->save()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Ekstrakurikuler berhasil disimpan.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                $validator = Validator::make($request->all(), [
                    'extracurricular_image' => 'mimes:jpg,jpeg,png|max:512|nullable'
                ]);
                if ($validator->fails()) {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => 'Berkas Harus Berekstensi jpg, jpeg, png dan Ukuran maksimal 512 Kb'];
                }
                try {
                    $extracurricular = Extracurricular::find($request->extracurricular_id);
                    if ($request->hasFile('extracurricular_image')){
                        $file = $request->file('extracurricular_image');
                        Storage::delete('public/portal/fronted/images/extracurricular/'. $extracurricular->extracurricular_image);
                        $file->store('public/portal/fronted/images/extracurricular/');
                    }
                    $extracurricular->extracurricular_image = isset($file) ? $file->hashName() : null;
                    $extracurricular->extracurricular_name  = $request->extracurricular_name;
                    $extracurricular->extracurricular_desc  = $request->extracurricular_desc;
                    $extracurricular->extracurricular_link  = $request->extracurricular_link;
                    if ( $extracurricular->save()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Ekstrakurikuler berhasil diperbarui.'];
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
}
