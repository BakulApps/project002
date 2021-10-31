<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Models\Admission\Setting;
use App\Models\Admission\Student;
use App\Models\Admission\User;
use App\Models\Master\School;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
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
        return view('admission.backend.home', $this->data);
    }

    public function student(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all') {
                $no = 1;
                foreach (Student::orderBy('student_name')->get() as $student) {
                    $data[] = [
                        $no++,
                        $student->student_name,
                        $student->student_nisn,
                        $student->student_birthplace .", ". Carbon::parse($student->student_birthday)->translatedFormat('d F Y'),
                        $student->student_father_name,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'. $student->student_id .'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="' . $student->student_id . '"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            return response()->json($msg);
        }
        else {
            return view('admission.backend.student');
        }
    }

    public function studentadd(Request $request)
    {
        return view('admission.backend.studentadd');
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
                        '**************',
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
            elseif ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(), [
                        'user_fullname' => 'required',
                        'user_name' => 'required',
                        'user_pass' => 'required',
                        'user_role' => 'required',
                    ], [
                        'user_fullname.required' => 'Kolom nama lengkap tidak boleh kosong.',
                        'user_name.required' => 'Kolom nama pengguna tidak boleh kosong.',
                        'user_pass.required' => 'Kolom kata sandi tidak boleh kosong.',
                        'user_role.required' => 'Silahkan pilih tipe pengguna.',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $user = new User();
                        $user->user_fullname = $request->user_fullname;
                        $user->user_name = $request->user_name;
                        $user->user_pass = Hash::make($request->user_pass);
                        $user->user_email = $request->user_email;
                        $user->user_role = $request->user_role;
                        $user->user_desc = $request->user_desc;
                        $user->save();
                        $msg = ['status' => 'success', 'title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Pengguna berhasil disimpan.'];
                    }
                }
                catch (\Exception $e) {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'data' && $request->_data == 'user'){
                $msg = User::find($request->user_id);
            }
            elseif ($request->_type == 'update'){
                try {

                    $user = User::find($request->user_id);
                    $user->user_fullname    = $request->user_fullname;
                    $user->user_name        = $request->user_name;
                    $user->user_email       = $request->user_email;
                    $user->user_role        = $request->user_role;
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
            return view('admission.backend.user', $this->data);
        }
    }

    public function setting(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->_type == 'update' && $request->_data == 'setting'){
                try {
                    $validator = Validator::make($request->all(), [
                        'app_name' => 'required',
                        'app_alias' => 'required',
                        'app_year' => 'required',
                        'app_logo' => 'mimes:jpg,peg,png|max:512',
                    ], [
                        'app_name.required' => 'Kolom nama aplikasi tidak boleh kosong.',
                        'app_alias.required' => 'Kolom nama alias tidak boleh kosong.',
                        'app_year.required' => 'Kolom tahun pelajaran tidak boleh kosong.',
                        'app_logo.mimes' => 'Logo aplikasi harus berformat jpg/jpeg/png.',
                        'app_logo.max' => 'Logo aplikasi maksimal berukuran 512Kb.',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $setting = $this->data['setting'];
                        $file = $request->file('app_logo');
                        if ($file != null){
                            Storage::delete('/public/admission/backend/images/'. $setting->value('app_logo'));
                            $file->store('public/admission/backend/images');
                            $setting->where('setting_name', 'app_logo')->update(['setting_value' => $file->hashName()]);
                        }
                        $setting->where('setting_name', 'app_name')->update(['setting_value' => $request->app_name]);
                        $setting->where('setting_name', 'app_alias')->update(['setting_value' => $request->app_alias]);
                        $setting->where('setting_name', 'app_year')->update(['setting_value' => $request->app_year]);
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
            return view('admission.backend.setting', $this->data);
        }
    }
}
