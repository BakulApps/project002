<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Portal\Section;
use App\Models\Portal\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{

    protected $data;

    public function __construct()
    {
        $this->data['setting'] = new Setting();
        $this->data['section'] = new Section();
    }

    public function home(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_data == 'about'){
                try {
                    $validator = Validator::make($request->all(), [
                        'home_section_about_name' => 'required',
                        'home_section_about_title' => 'required',
                        'home_section_about_content' => 'required',
                        'home_section_about_image' => 'required|mimes:jpg,jpeg,png|max:512'
                    ], [
                        'home_section_about_name.required' => 'Kolom Nama Section tidak boleh kosong.',
                        'home_section_about_title.required' => 'Kolom Judul Section tidak boleh kosong.',
                        'home_section_about_content.required' => 'Kolom Diskripsi Section tidak boleh kosong.',
                        'home_section_about_image.required' => 'Gambar tidak boleh Kosong.',
                        'home_section_about_image.mimes' => 'Gambar harus berformat jpg/jpeg/png.',
                        'home_section_about_image.max' => 'Ukuran gambar maksimal 512Kb.'
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        if ($request->hasFile('home_section_about_image')){
                            $file = $request->file('home_section_about_image');
                            Storage::delete('public/portal/images/home/'. Section::where('section_name','home_section_about_image')->value('section_content'));
                            $file->store('public/portal/images/home/');
                            Section::where('section_name', 'home_section_about_image')->update(['section_content' => $file->hashName()]);
                        }
                        Section::where('section_name', 'home_section_about_name')->update(['section_content' => $request->home_section_about_name]);
                        Section::where('section_name', 'home_section_about_title')->update(['section_content' => $request->home_section_about_title]);
                        Section::where('section_name', 'home_section_about_content')->update(['section_content' => $request->home_section_about_content]);
                        Section::where('section_name', 'home_section_about_link')->update(['section_content' => $request->home_section_about_link]);
                        Section::where('section_name', 'home_section_about_button')->update(['section_content' => $request->home_section_about_button]);
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Halaman Beranda berhasil diperbarui.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Sukses !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_data == 'youtube'){
                try {
                    $validator = Validator::make($request->all(), [
                        'home_section_yt_youtube' => 'required',
                        'home_section_yt_background' => 'required|mimes:jpg,jpeg,png|max:512'
                    ], [
                        'home_section_yt_youtube.required' => 'Tautan Youtube tidak boleh kosong.',
                        'home_section_yt_background.required' => 'Gambar tidak boleh Kosong.',
                        'home_section_yt_background.mimes' => 'Gambar harus berformat jpg/jpeg/png.',
                        'home_section_yt_background.max' => 'Ukuran gambar maksimal 512Kb.'
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        if ($request->hasFile('home_section_yt_background')){
                            $file = $request->file('home_section_yt_background');
                            Storage::delete('public/portal/images/home/'. Section::where('section_name','home_section_yt_background')->value('section_content'));
                            $file->store('public/portal/images/home/');
                            Section::where('section_name', 'home_section_yt_background')->update(['section_content' => $file->hashName()]);
                        }
                        Section::where('section_name', 'home_section_yt_youtube')->update(['section_content' => $request->home_section_yt_youtube]);
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Halaman Beranda berhasil diperbarui.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Sukses !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('portal.backend.page_home', $this->data);
        }
    }
}
