<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Imports\Master\StudentImport;
use App\Models\Master\School;
use App\Models\Master\Student;
use App\Models\Master\Year;
use App\Models\Student\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

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
        return view('student.backend.home', $this->data);
    }

    public function student(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Student::orderBy('student_name', 'ASC')->get() as $student){
                    $data[] = [
                        $no++,
                        $student->student_name,
                        $student->student_nisn,
                        $student->student_birthplace,
                        $student->birthday('d/m/Y'),
                        $student->classes()->where('class_year', Year::active())->value('class_alias'),
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$student->student_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$student->student_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'class'){
                $msg = Classes::where('class_id', $request->class_id)->first();
            }
            elseif ($request->_type == 'delete'){
                try {
                    $class = Classes::find($request->class_id);
                    if ($class->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Kelas berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(),[
                        'class_level' => 'required',
                        'class_major' => 'required',
                        'class_name' => 'required',
                        'class_alias' => 'required',
                    ], [
                        'class_level.required' => 'Kolom Tingkat Tidak boleh kosong, silahkah pilih Tingkat',
                        'class_major.required' => 'Kolom Jurusan Tidak boleh kosong, silahkah pilih Jurusan',
                        'class_name.required' => 'Kolom Rombel Tidak boleh kosong',
                        'class_alias.required' => 'Kolom Nama Kelas Tidak boleh kosong',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else{
                        $class = Classes::find($request->class_id);
                        $class->class_year = Year::active();
                        $class->class_level = $request->class_level;
                        $class->class_major = $request->class_major;
                        $class->class_name = $request->class_name;
                        $class->class_alias = $request->class_alias;
                        if ($class->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Kelas berhasil diperbarui.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'data' && $request->_data == 'upload'){
                try {
                    $validator = Validator::make($request->all(), [
                        'class_id' => 'required',
                        'data_student' => 'required|mimes:xls,xlsx'
                    ], [
                        'class_id.required' => 'Silahkan pilih kelas/Rombel terlebih dahulu.',
                        'data_student.required' => 'Silahkan pilih berkas terlebih dahulu.',
                        'data_student.mimes' => 'Berkas harus berformat xls/xlsx'
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $file = $request->file('data_student')->store('temp');
                        $path = storage_path('app') .'/'. $file;
                        if (Excel::import(new StudentImport(), $path)) {
                            $msg = ['title' => 'Berhasil !', 'class' => 'success', 'text' => 'Data Siswa Berhasil ditambahkan'];
                        }
                    }

                }
                catch (\Exception $e) {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('student.backend.student_all', $this->data);
        }
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
