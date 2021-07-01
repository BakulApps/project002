<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Portal\Comment;
use App\Models\Portal\Event;
use App\Models\Portal\Post;
use App\Models\Portal\Setting;
use App\Models\Portal\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
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

    public function user(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all') {
                $no = 1;
                foreach (User::with('role')->orderBy('user_fullname')->get() as $user) {
                    $data[] = [
                        $no++,
                        $user->user_fullname,
                        $user->user_name,
                        '',
                        $user->user_email,
                        $user->role->role_name,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'. $user->user_id .'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="' . $user->user_id . '"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'user'){
                $msg = User::find($request->user_id);
            }
            elseif ($request->_type == 'store'){
                $user = new User();
                $user->user_fullname = $request->user_fullname;
                $user->user_name = $request->user_name;
                $user->user_pass = Hash::make($request->user_pass);
                $user->user_email = $request->user_email;
                $user->user_role = $request->user_role;
                $user->user_facebook = $request->user_facebook;
                $user->user_instagram = $request->user_instagram;
                $user->user_twitter = $request->user_twitter;
                $user->user_desc = $request->user_desc;
                try {
                    if ($user->save()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Pengguna berhasil diperbarui.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                $validator = Validator::make($request->all(), [
                    'user_image' => 'mimes:jpg,jpeg,png|max:512|nullable'
                ]);
                if ($validator->fails()) {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => 'Berkas Harus Berekstensi jpg, jpeg, png dan Ukuran maksimal 512 Kb'];
                }
                try {
                    if ($request->hasFile('user_image')){
                        $file = $request->file('user_image')->store('public/user');
                    }
                    $user = User::find($request->user_id);
                    $user->user_image       = isset($file) ? asset('storage' . preg_replace("/public/", "", $file)) : null;
                    $user->user_fullname    = $request->user_fullname;
                    $user->user_name        = $request->user_name;
                    $user->user_email       = $request->user_email;
                    $user->user_role        = $request->user_role;
                    $user->user_facebook    = $request->user_facebook;
                    $user->user_instagram   = $request->user_instagram;
                    $user->user_twitter     = $request->user_twitter;
                    $user->user_desc        = $request->user_desc;
                    $request->user_pass == '' ? null : $user->user_pass = Hash::make($request->user_pass);
                    if ( $user->save()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Pengguna berhasil diperbarui.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                $user = User::find($request->user_id);
                try {
                    if ($user->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Pengguna berhasil dihapus.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('portal.backend.user', $this->data);
        }
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
