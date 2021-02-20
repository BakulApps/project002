<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Portal\Setting;
use App\Models\Portal\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['setting'] = new Setting();
    }

    public function slider(Request $request)
    {
        if ($request->isMethod('get')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Slider::OrderBy('slider_status', 'DESC')->get() as $slider){
                    $data[] = [
                        $no++,
                        $slider->slider_title,
                        $slider->slider_content,
                        '<img src="'.asset($slider->slider_image).'" style="width: 120px"/>',
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
            else {
                return view('portal.backend.page_slider', $this->data);
            }
        }
        elseif ($request->isMethod('post')){
            $validator = Validator::make($request->all(), [
                'slider_image' => 'mimes:jpg,jpeg,png|max:512|nullable'
            ]);
            if ($validator->fails()) {
                $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => 'Berkas Harus Berekstensi jpg, jpeg, png dan Ukuran maksimal 512 Kb'];
            }
            try {
                if ($request->hasFile('slider_image')){
                    $file = $request->file('slider_image')->store('public/portal/fronted/images/slider/');
                }
                $slider = new Slider();
                $slider->slider_image          = isset($file) ? asset('storage' . preg_replace("/public/portal/fronted/images/slider/", "", $file)) : null;
                $slider->slider_title          = $request->slider_title;
                $slider->slider_content        = $request->slider_content;
                $slider->slider_button_link_1       = $request->slider_button_link_1;
                $slider->slider_button_name_1        = $request->slider_button_name_1;
                $slider->slider_button_link_2    = $request->slider_button_link_2;
                $slider->slider_button_name_2   = $request->slider_button_name_2;
                $slider->slider_status     = $request->slider_status;
                if ( $slider->save()){
                    $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Slider berhasil disimpan.'];
                }
            }catch (\Exception $e){
                $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
            }
        }
        elseif ($request->isMethod('delete')){
            try {
                $slider = Slider::find($request->slider_id);
                if ($slider->delete()){
                    $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Slider berhasil dihapus.'];
                }
            }catch (\Exception $e){
                $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
            }
        }
        return response()->json($msg);
    }
}
