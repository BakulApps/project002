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
                        'home_section_about_image' => 'mimes:jpg,jpeg,png|max:512'
                    ], [
                        'home_section_about_name.required' => 'Kolom Nama Section tidak boleh kosong.',
                        'home_section_about_title.required' => 'Kolom Judul Section tidak boleh kosong.',
                        'home_section_about_content.required' => 'Kolom Diskripsi Section tidak boleh kosong.',
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
                        'home_section_yt_background' => 'mimes:jpg,jpeg,png|max:512'
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
            elseif($request->_data == 'section-4'){
                try {
                    $validator = Validator::make($request->all(), [
                        'home_section_4_title_1' => 'required',
                        'home_section_4_content_1' => 'required',
                        'home_section_4_icon_1' => 'mimes:jpg,jpeg,png|max:512',
                        'home_section_4_title_2' => 'required',
                        'home_section_4_content_2' => 'required',
                        'home_section_4_icon_2' => 'mimes:jpg,jpeg,png|max:512',
                        'home_section_4_title_3' => 'required',
                        'home_section_4_content_3' => 'required',
                        'home_section_4_icon_3' => 'mimes:jpg,jpeg,png|max:512'
                    ], [

                        'home_section_4_title_1.required' => 'Kolom Judul-1 tidak boleh kosong',
                        'home_section_4_content_1.required' => 'Kolom Konten-1 tidak boleh kosong',
                        'home_section_4_icon_1.mimes' => 'Gambar harus berformat jpg/jpeg/png.',
                        'home_section_4_icon_1.max' => 'Ukuran gambar maksimal 512Kb.',
                        'home_section_4_title_2.required' => 'Kolom Judul-2 tidak boleh kosong',
                        'home_section_4_content_2.required' => 'Kolom Konten-2 tidak boleh kosong',
                        'home_section_4_icon_2.mimes' => 'Gambar harus berformat jpg/jpeg/png.',
                        'home_section_4_icon_2.max' => 'Ukuran gambar maksimal 512Kb.',
                        'home_section_4_title_3.required' => 'Kolom Konten-3 tidak boleh kosong',
                        'home_section_4_content_3.required' => 'Kolom Konten-3 tidak boleh kosong',
                        'home_section_4_icon_3.mimes' => 'Gambar harus berformat jpg/jpeg/png.',
                        'home_section_4_icon_3.max' => 'Ukuran gambar maksimal 512Kb.'
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        if ($request->hasFile('home_section_4_icon_1')){
                            $file = $request->file('home_section_4_icon_1');
                            Storage::delete('public/portal/images/home/'. Section::where('section_name','home_section_4_icon_1')->value('section_content'));
                            $file->store('public/portal/images/home/');
                            Section::where('section_name', 'home_section_4_icon_1')->update(['section_content' => $file->hashName()]);
                        }
                        if ($request->hasFile('home_section_4_icon_2')){
                            $file = $request->file('home_section_4_icon_2');
                            Storage::delete('public/portal/images/home/'. Section::where('section_name','home_section_4_icon_2')->value('section_content'));
                            $file->store('public/portal/images/home/');
                            Section::where('section_name', 'home_section_4_icon_2')->update(['section_content' => $file->hashName()]);
                        }
                        if ($request->hasFile('home_section_4_icon_3')){
                            $file = $request->file('home_section_4_icon_3');
                            Storage::delete('public/portal/images/home/'. Section::where('section_name','home_section_4_icon_3')->value('section_content'));
                            $file->store('public/portal/images/home/');
                            Section::where('section_name', 'home_section_4_icon_3')->update(['section_content' => $file->hashName()]);
                        }
                        Section::where('section_name', 'home_section_4_title_1')->update(['section_content' => $request->home_section_4_title_1]);
                        Section::where('section_name', 'home_section_4_content_1')->update(['section_content' => $request->home_section_4_content_1]);
                        Section::where('section_name', 'home_section_4_title_2')->update(['section_content' => $request->home_section_4_title_2]);
                        Section::where('section_name', 'home_section_4_content_2')->update(['section_content' => $request->home_section_4_content_2]);
                        Section::where('section_name', 'home_section_4_title_3')->update(['section_content' => $request->home_section_4_title_3]);
                        Section::where('section_name', 'home_section_4_content_3')->update(['section_content' => $request->home_section_4_content_3]);
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
