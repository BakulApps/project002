<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Master\School;
use App\Models\Student\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BackendController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['school'] = School::first();
        $this->data['setting'] = new Setting();
    }
    public function home()
    {
        return 'Hamalan Beranda Backend';
    }

    public function setting(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'update' && $request->_data == 'setting'){
                try {
                    $validator = Validator::make($request->all(), [
                        'app_name' => 'required',
                        'app_alias' => 'required',
                        'app_logo' => 'required|mimes:jpg,peg,png|max:512',
                    ], [
                        'app_name.required' => 'Kolom nama aplikasi tidak boleh kosong.',
                        'app_alias.required' => 'Kolom nama alias tidak boleh kosong.',
                        'app_logo.required' => 'Logo aplikasi tidak boleh kosong.',
                        'app_logo.mimes' => 'Logo aplikasi harus berformat jpg/jpeg/png.',
                        'app_logo.max' => 'Logo aplikasi maksimal berukuran 512Kb.',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $setting = $this->data['setting'];
                        $file = $request->file('app_logo');
                        Storage::delete('/public/student/images/'. $setting->value('app_logo'));
                        $file->store('public/student/images');
                        $setting->where('setting_name', 'app_name')->update(['setting_value' => $request->app_name]);
                        $setting->where('setting_name', 'app_alias')->update(['setting_value' => $request->app_alias]);
                        $setting->where('setting_name', 'app_logo')->update(['setting_value' => $file->hashName()]);
                        $setting->where('setting_name', 'app_desc')->update(['setting_value' => $request->app_desc]);
                        $msg = ['status' => 'success', 'title' => 'Sukses !', 'class' => 'success', 'text' => 'Pengaturan berhasil disimpan.'];
                    }
                }
                catch (\Exception $e)
                {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('student.backend.setting', $this->data);
        }
    }
}
