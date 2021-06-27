<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Portal\Comment;
use App\Models\Portal\Event;
use App\Models\Portal\Post;
use App\Models\Portal\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;

class BackendController extends Controller
{
    public $data;

    public function __construct()
    {
        $this->data['setting'] = new Setting();
    }

    public function home()
    {
        $this->data['posts'] = Post::all();
        $this->data['events'] = Event::all();
        $this->data['comments'] = Comment::all();
        return view('portal.backend.home', $this->data);
    }

    public function setting(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'app' && $request->_data == 'setting'){
                try {
                    $validator = Validator::make($request->all(), [
                        'app_name' => 'required',
                        'app_desc' => 'required',
                        'app_logo' => 'mimes:jpg,jpeg,png|max:512'
                    ], [
                        'app_name.required' => 'Kolom Nama Aplikasi tidak boleh kosong.',
                        'app_desc.required' => 'Kolom Diskripsi Aplikasi tidak boleh kosong.',
                        'app_logo.mimes' => 'Gambar harus berformat jpg.jpeg.png.',
                        'app_logo.max' => 'Ukuran Maksimal Gambar 512Kb.',
                    ]);
                    if ($validator->fails()) {

                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $setting = $this->data['setting'];
                        if ($request->hasFile('app_logo')){
                            $file = $request->file('app_logo');
                            Storage::delete('/public/portal/images/'. $setting->value('app_logo'));
                            $file->store('public/portal/images');
                            $setting->where('setting_name', 'app_logo')->update(['setting_value' => $file->hashName()]);
                        }
                        $setting->where('setting_name', 'app_name')->update(['setting_value' => $request->app_name]);
                        $setting->where('setting_name', 'app_desc')->update(['setting_value' => $request->app_desc]);
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Pengaturan berhasil disimpan.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan!', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'school' && $request->_data == 'setting'){
                try {
                    $validator = Validator::make($request->all(), [
                        'school_logo' => 'mimes:jpg,jpeg,png|max:512',
                        'school_name' => 'required',
                        'school_phone' => 'required',
                        'school_email' => 'required',
                        'school_address' => 'required',
                        'school_village' => 'required',
                        'school_subdistric' => 'required',
                        'school_distric' => 'required',
                        'school_province' => 'required',
                    ], [
                        'school_logo.mimes' => 'Gambar harus berformat jpg.jpeg.png.',
                        'school_logo.max' => 'Ukuran Maksimal Gambar 512Kb.',
                        'school_name.required' => 'Kolom Nama Madrasah tidak boleh kosong.',
                        'school_phone.required' => 'Kolom Telepon Madrasah tidak boleh kosong.',
                        'school_email.required' => 'Kolom Email Madrasah tidak boleh kosong.',
                        'school_address.required' => 'Kolom Alamat Madrasah tidak boleh kosong.',
                        'school_village.required' => 'Kolom Desa Madrasah tidak boleh kosong.',
                        'school_subdistric.required' => 'Kolom Kecamatan Madrasah tidak boleh kosong.',
                        'school_distric.required' => 'Kolom Kabupaten Madrasah tidak boleh kosong.',
                        'school_province.required' => 'Kolom Propinsi Madrasah tidak boleh kosong.'
                    ]);
                    if ($validator->fails()) {

                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $setting = $this->data['setting'];
                        if ($request->hasFile('school_logo')){
                            $file = $request->file('school_logo');
                            Storage::delete('/public/portal/images/'. $setting->value('school_logo'));
                            $file->store('public/portal/images');
                            $setting->where('setting_name', 'school_logo')->update(['setting_value' => $file->hashName()]);
                        }
                        $setting->where('setting_name', 'school_name')->update(['setting_value' => $request->school_name]);
                        $setting->where('setting_name', 'school_phone')->update(['setting_value' => $request->school_phone]);
                        $setting->where('setting_name', 'school_email')->update(['setting_value' => $request->school_email]);
                        $setting->where('setting_name', 'school_address')->update(['setting_value' => $request->school_address]);
                        $setting->where('setting_name', 'school_village')->update(['setting_value' => $request->school_village]);
                        $setting->where('setting_name', 'school_subdistric')->update(['setting_value' => $request->school_subdistric]);
                        $setting->where('setting_name', 'school_distric')->update(['setting_value' => $request->school_distric]);
                        $setting->where('setting_name', 'school_province')->update(['setting_value' => $request->school_province]);
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Pengaturan berhasil disimpan.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan!', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('portal.backend.setting', $this->data);
        }
    }
}
