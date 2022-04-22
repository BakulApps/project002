<?php

namespace App\Http\Controllers\Graduate;

use App\Exports\Graduate\StudentExport;
use App\Exports\Graduate\ValueExport;
use App\Http\Controllers\Controller;
use App\Imports\Graduate\StudentImport;
use App\Imports\Graduate\ValueImport;
use App\Models\Graduate\Announcement;
use App\Models\Graduate\Setting;
use App\Models\Graduate\Student;
use App\Models\Graduate\Value;
use App\Models\Master\School;
use App\Models\Master\Subject;
use App\Models\Master\Year;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BackendController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['school'] = new School();
        $this->data['setting'] = new Setting();
    }

    public function home()
    {
        return view('graduate.backend.home', $this->data);
    }

    public function student(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Student::OrderBy('student_class')->OrderBy('student_name')->get() as $student){
                    $data[] = [
                        $no++,
                        $student->student_name,
                        $student->student_nisn,
                        $student->student_nism,
                        $student->student_number_exam,
                        $student->student_class,
                        $student->student_place_birth . ', ' . Carbon::createFromFormat('Y-m-d', $student->student_birthday)->translatedFormat('d M Y'),
                        $student->student_gender == 'L' ? 'Laki-laki' : 'Perempuan',
                        $student->student_father,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$student->student_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$student->student_id.'"><i class="icon-trash"></i></button>
                        </div>
                     '
                    ];
                }
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'upload'){
                $validator = Validator::make($request->all(), [
                    'data_student' => 'mimes:xls,xlsx'
                ]);
                if ($validator->fails()) {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => 'Berkas Harus Berekstensi xls/xlsx'];
                }
                else {
                    try {
                        if ($request->hasFile('data_student')) {
                            $file = $request->file('data_student')->store('temp');
                            $path = storage_path('app') .'/'. $file;
                            Student::query()->truncate();
                            if (Excel::import(new StudentImport(), $path)) {
                                $msg = ['title' => 'Berhasil !', 'class' => 'success', 'text' => 'Data Siswa Berhasil ditambahkan'];
                            }
                        }
                    } catch (\Exception $e) {
                        $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                    }
                }
            }
            elseif ($request->_type == 'data' && $request->_data == 'student'){
                $student = Student::where('student_id', $request->student_id)->first();
                $student->student_birthday = Carbon::parse($student->student_birthday)->format('d/m/Y');
                $msg = $student;
            }
            elseif ($request->_type == 'delete'){
                try {
                    $student = Student::where('student_id', $request->student_id)->first();
                    if ($student->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Siswa berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    $student = Student::find($request->student_id);
                    if ($student->update([
                        'student_name' => $request->student_name,
                        'student_nisn' => $request->student_nisn,
                        'student_nism' => $request->student_nism,
                        'student_number_exam' => $request->student_number_exam,
                        'student_class' => $request->student_class,
                        'student_place_birth' => $request->student_place_birth,
                        'student_birthday' => Carbon::createFromFormat('d/m/Y', $request->student_birthday)->format('Y-m-d'),
                        'student_gender' => $request->student_gender,
                        'student_address' => $request->student_address,
                        'student_father' => $request->student_father,
                        'student_mother' => $request->student_mother])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Siswa berhasil diperbarui.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        elseif ($request->_type == 'download' && $request->_data == 'student'){
            return Excel::download(new StudentExport(), 'data_siswa.xlsx');
        }
        else {
            return view('graduate.backend.student', $this->data);
        }
    }

    public function value(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $students = Student::with('value')->get();
                foreach ($students as $student){
                    $values = [];
                    foreach ($student->value as $value){
                        $values[] = $value->value_point;
                    }
                    $data[] = array_merge([$student->student_name], $values);
                }
                $msg['data'] = empty($values) ? [] : $data;
            }
            elseif ($request->_type == 'data' && $request->_data == 'upload'){
                $validator = Validator::make($request->all(), [
                    'value' => 'mimes:xls,xlsx'
                ]);
                if ($validator->fails()) {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => 'Berkas Harus Berekstensi xls/xlsx'];
                }
                else {
                    try {
                        if ($request->hasFile('value')) {
                            $file = $request->file('value')->store('temp');
                            $path = storage_path('app') .'/'. $file;
                            Value::query()->truncate();
                            if (Excel::import(new ValueImport(), $path)) {
                                $msg = ['title' => 'Berhasil !', 'class' => 'success', 'text' => 'Data Nilai Berhasil ditambahkan'];
                            }
                        }
                    } catch (\Exception $e) {
                        $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                    }
                }
            }
            return response()->json($msg);
        }
        elseif ($request->_type == 'download' && $request->_data == 'value'){
            return Excel::download(new ValueExport(), 'data_nilai.xlsx');
        }
        else {
            $this->data['subjects'] = Subject::orderBy('subject_number')->get();
            return view('graduate.backend.value', $this->data);
        }
    }

    public function announcement(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                $announcements = new Announcement();
                foreach ($announcements->get() as $announcement){
                    $data[] = [
                        $announcement->announcement_uuid,
                        $announcement->announcement_number . $this->data['setting']->value('announcement_letter'),
                        $announcement->student->student_name,
                        $announcement->announcement_value_total,
                        $announcement->announcement_status == 1 ? '<span class="badge badge-success">lulus</span>' :'<span class="badge badge-danger">tidak</span>',
                        $announcement->announcement_view,
                        $announcement->announcement_print,
                        $announcement->announcement_finance == 1 ? '<span class="badge badge-success">lunas</span>' :'<span class="badge badge-danger">belum</span>',
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$announcement->announcement_id.'"><i class="icon-pencil"></i></button>
                        </div>
                     '
                    ];
                }
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'announcement'){
                $announcement = Announcement::with('student')
                    ->where('announcement_id', $request->announcement_id)->first();
                $data = ['announcement' => $announcement, 'student' => $announcement->student];
                $msg = $data;
            }
            elseif ($request->_type == 'update'){
                try {
                    $announcement = Announcement::where(['announcement_id' => $request->announcement_id]);
                    if ($announcement->update([
                        'announcement_status' => $request->announcement_status,
                        'announcement_finance' => $request->announcement_finance,])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Kelulusan berhasil diperbarui.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'store'){
                $path = storage_path('app/public/graduate/images/qr/');
                if (!file_exists($path)){
                    mkdir($path, 0777);
                }
                else {
                    $files = glob($path . '*.png');
                    foreach ($files as $file){
                        File::delete($file);
                    }
                }
                Announcement::query()->truncate();
                $students = Student::with('announcement');
                $number = 1;
                foreach ($students->get() as $student){
                    $value_total= 0;
                    foreach ($student->value as $value){
                        $value_total = $value_total + $value->value_point;
                    }
                    $uuid = Factory::create('id_ID')->uuid;
                    $student->announcement()->create([
                        'announcement_uuid' => $uuid,
                        'announcement_number' => sprintf('%03d', $number++),
                        'announcement_value_total' => $value_total,
                        'announcement_status' => 1,
                        'announcement_view' => 0,
                        'announcement_print' => 0,
                        'announcement_finance' => 1,
                    ]);
                    QrCode::size(1024)->format('png')
                        ->generate(route('graduate.home.authentication', ['uuid' => $uuid]),
                            storage_path('app/public/graduate/images/qr/'. $uuid . '.png'));

                }
                $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Kelulusan berhasil dibuat.'];

            }
            return response()->json($msg);
        }
        else {
            return view('graduate.backend.announcement', $this->data);
        }
    }

    public function setting(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'update' && $request->_data == 'app'){
                $setting = $this->data['setting'];
                if ($request->hasFile('app_logo')) {
                    $file = $request->file('app_logo');
                    Storage::delete('/public/graduate/images/'. $setting->value('app_logo'));
                    $file->store('public/graduate/images');
                    $app_logo = $file->hashName();
                }
                else {
                    $app_logo = $setting->value('app_logo');
                }
                try {
                    $setting->where('setting_name', 'app_name')->update(['setting_value' => $request->app_name]);
                    $setting->where('setting_name', 'app_alias')->update(['setting_value' => $request->app_alias]);
                    $setting->where('setting_name', 'app_logo')->update(['setting_value' => $app_logo]);
                    $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Pengaturan berhasil disimpan.'];
                }
                catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update' && $request->_data == 'announcement'){
                $setting = $this->data['setting'];
                try {
                    $setting->where('setting_name', 'announcement_letter')->update(['setting_value' => $request->announcement_letter]);
                    $setting->where('setting_name', 'announcement_date')->update(['setting_value' => $request->announcement_date]);
                    $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Pengaturan berhasil disimpan.'];
                }
                catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update' && $request->_data == 'database'){
                try {
                    switch ($request->table){
                        case 1:
                            Year::truncate();
                            break;
                        case 2:
                            Subject::truncate();
                            break;
                        case 3:
                            Student::truncate();
                            break;
                        case 4:
                            Value::truncate();
                            break;
                        case 5:
                            Announcement::truncate();
                            break;
                        default;
                    }
                    $msg = ['title' => 'Berhasil !', 'class' => 'success', 'text' => 'Database berhasil di kosongkan.'];
                }
                catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('graduate.backend.setting', $this->data);
        }
    }
}
