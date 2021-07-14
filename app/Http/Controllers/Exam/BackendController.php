<?php

namespace App\Http\Controllers\Exam;

use App\Exports\Exam\StudentExport;
use App\Http\Controllers\Controller;
use App\Imports\Exam\StudentImport;
use App\Models\Exam\Classes;
use App\Models\Exam\Level;
use App\Models\Exam\Major;
use App\Models\Exam\Role;
use App\Models\Exam\Schedule;
use App\Models\Exam\Setting;
use App\Models\Exam\Student;
use App\Models\Exam\Subject;
use App\Models\Exam\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class BackendController extends Controller
{
    protected $data;

    public function __construct()
    {

        $this->data['setting'] = new Setting();
    }

    public function home()
    {
        return view('exam.backend.home', $this->data);
    }

    public function subject(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Subject::OrderBy('subject_name')->get() as $subject){
                    $data[] = [
                        $no++,
                        $subject->subject_code,
                        $subject->subject_name,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$subject->subject_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$subject->subject_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'subject'){
                $msg = Subject::where('subject_id', $request->subject_id)->first();
            }
            elseif ($request->_type == 'select' && $request->_data == 'subject'){
                $subjects = Subject::all();
                foreach ($subjects as $subject){
                    $msg[] = ['id' => $subject->subject_id, 'text' => $subject->subject_name];
                }
            }
            elseif ($request->_type == 'store'){
                try {
                    if (Subject::create([
                        'subject_code' => $request->subject_code,
                        'subject_name' => $request->subject_name,

                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Mata Pelajaran berhasil di simpan.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    if (Subject::where('subject_id', $request->subject_id)->update([
                        'subject_code' => $request->subject_code,
                        'subject_name' => $request->subject_name,
                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Mata Pelajaran berhasil diperbarui.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $subject = Subject::find($request->subject_id);
                    if ($subject->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Mata Pelajaran berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('exam.backend.subject', $this->data);
        }
    }

    public function level(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Level::OrderBy('level_name')->get() as $level){
                    $data[] = [
                        $no++,
                        $level->level_name,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$level->level_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$level->level_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'level'){
                $msg = Level::where('level_id', $request->level_id)->first();
            }
            elseif ($request->_type == 'select' && $request->_data == 'level'){
                $levels = Level::all();
                foreach ($levels as $level){
                    $msg[] = ['id' => $level->level_id, 'text' => 'Kelas '. $level->level_name];
                }
            }
            elseif ($request->_type == 'store'){
                try {
                    if (Level::create([
                        'level_name' => $request->level_name,

                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Tingkat berhasil di simpan.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    if (Level::where('level_id', $request->level_id)->update([
                        'level_name' => $request->level_name,
                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Tingkat berhasil diperbarui.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $level = Level::find($request->level_id);
                    if ($level->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Tingkat berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('exam.backend.level', $this->data);
        }
    }

    public function major(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Major::OrderBy('major_name')->get() as $major){
                    $data[] = [
                        $no++,
                        $major->major_code,
                        $major->major_name,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$major->major_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$major->major_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'major'){
                $msg = Major::where('major_id', $request->major_id)->first();
            }
            elseif ($request->_type == 'select' && $request->_data == 'major'){
                $majors = Major::all();
                foreach ($majors as $major){
                    $msg[] = ['id' => $major->major_id, 'text' => $major->major_name];
                }
            }
            elseif ($request->_type == 'select' && $request->_data == 'major'){
                $majors = Major::all();
                foreach ($majors as $major){
                    $msg[] = ['id' => $major->major_id, 'text' => $major->major_id .' - '. $major->major_name];
                }
            }
            elseif ($request->_type == 'store'){
                try {
                    if (Major::create([
                        'major_code' => $request->major_code,
                        'major_name' => $request->major_name,

                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Jurusan berhasil di simpan.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    if (Major::where('major_id', $request->major_id)->update([
                        'major_code' => $request->major_code,
                        'major_name' => $request->major_name,
                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Jurusan berhasil diperbarui.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $major = Major::find($request->major_id);
                    if ($major->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Jurusan berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('exam.backend.major', $this->data);
        }
    }

    public function classes(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Classes::orderBy('class_level')->orderBy('class_major')->orderBy('class_code')->get() as $class){
                    $data[] = [
                        $no++,
                        $class->level->level_name,
                        $class->major->major_code,
                        $class->class_code,
                        $class->class_name,
                        $class->user->user_fullname,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$class->class_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$class->class_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'class'){
                $msg = Classes::where('class_id', $request->class_id)->first();
            }
            elseif ($request->_type == 'store'){
                try {
                    if (Classes::create([
                        'class_level' => $request->class_level,
                        'class_major' => $request->class_major,
                        'class_teacher' => $request->class_teacher,
                        'class_code' => $request->class_code,
                        'class_name' => $request->class_name

                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Kelas berhasil di simpan.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    if (Classes::where('class_id', $request->class_id)->update([
                        'class_level' => $request->class_level,
                        'class_major' => $request->class_major,
                        'class_code' => $request->class_code,
                        'class_name' => $request->class_name,
                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Kelas berhasil diperbarui.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
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
            return response()->json($msg);
        }
        else {
            return view('exam.backend.class', $this->data);
        }
    }

    public function role(Request $request){
        if ($request->isMethod('post')){
            if ($request->_type == 'select' && $request->_data == 'role') {
                $roles = Role::all();
                foreach ($roles as $role) {
                    $msg[] = ['id' => $role->role_id, 'text' => $role->role_name];
                }
            }
            return response()->json($msg);

        }
    }

    public function student(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all') {
                $no = 1;
                if (Auth::guard('exam')->user()->user_role == 2){
                    $class = Classes::where('class_teacher', Auth::guard('exam')->user()->user_id)->value('class_id');
                    $students = Student::where('student_class', $class)->orderBy('student_class', 'DESC')->orderBy('student_name')->get();
                }
                else {
                    $students = Student::orderBy('student_class', 'DESC')->orderBy('student_name')->get();
                }
                foreach ($students as $student) {
                    $data[] = [
                        $no++,
                        $student->student_number,
                        $student->student_name,
                        $student->classes->class_name,
                        $student->student_username,
                        $student->student_password,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'. $student->student_id .'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="' . $student->student_id . '"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'student'){
                $msg = Student::find($request->student_id);
                $msg->student_class = $msg->classes->class_name;
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
                            Student::truncate();
                            if (Excel::import(new StudentImport(), $path)) {
                                $msg = ['title' => 'Berhasil !', 'class' => 'success', 'text' => 'Data Siswa Berhasil ditambahkan'];
                            }
                        }
                    } catch (\Exception $e) {
                        $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                    }
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $student = Student::find($request->student_id);
                    if ($student->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Peserta berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        elseif ($request->_type == 'download' && $request->_data == 'student'){
            return Excel::download(new StudentExport(), 'data_peserta.xlsx');
        }
        else {
            return view('exam.backend.student', $this->data);
        }
    }

    public function schedule(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                if (Auth::guard('exam')->user()->user_role == 2){
                    $class = Classes::where('class_teacher', Auth::guard('exam')->user()->user_id)->first();
                    $schedules = Schedule::where('schedule_level', $class->class_level)
                        ->where('schedule_major', $class->class_major)
                        ->orWhere('schedule_major', 1)
                        ->orderBy('schedule_level')->orderBy('schedule_start')->get();
                    foreach ($schedules as $schedule){
                        $data[] = [
                            $no++,
                            $schedule->subject->subject_name,
                            $schedule->level->level_name,
                            $schedule->major->major_code,
                            Carbon::parse($schedule->schedule_start)->translatedFormat('l d/m/Y'),
                            Carbon::parse($schedule->schedule_start)->format('H:i'),
                            Carbon::parse($schedule->schedule_end)->format('H:i'),
                            $schedule->schedule_token,
                            '<div class="btn-group">
                            <a target="_blank" href="https://'.$schedule->schedule_link.'" class="btn btn-outline-primary bt-sm"><i class="icon-eye"></i></a>
                            <a target="_blank" href="https://'.$schedule->schedule_monitoring.'" class="btn btn-outline-primary bt-sm"><i class="icon-paperplane"></i></a>
                            <a href="'.route('exam.admin.schedule.monitoring', [$class->class_id, $schedule->schedule_id]).'" class="btn btn-outline-primary bt-sm"><i class="icon-chart"></i></a>
                         </div>
                         '
                        ];
                    };
                }
                else {
                    $schedules = Schedule::orderBy('schedule_level')->orderBy('schedule_start')->get();
                    foreach ($schedules as $schedule){
                        $data[] = [
                            $no++,
                            $schedule->subject->subject_name,
                            $schedule->level->level_name,
                            $schedule->major->major_code,
                            Carbon::parse($schedule->schedule_start)->translatedFormat('l d/m/Y'),
                            Carbon::parse($schedule->schedule_start)->format('H:i'),
                            Carbon::parse($schedule->schedule_end)->format('H:i'),
                            $schedule->schedule_token,
                            '<div class="btn-group">
                            <a target="_blank" href="https://'.$schedule->schedule_link.'" class="btn btn-outline-primary bt-sm"><i class="icon-eye"></i></a>
                            <a target="_blank" href="https://'.$schedule->schedule_monitoring.'" class="btn btn-outline-primary bt-sm"><i class="icon-paperplane"></i></a>
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$schedule->schedule_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$schedule->schedule_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                        ];
                    };
                }
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'schedule'){
                $msg = Schedule::where('schedule_id', $request->schedule_id)->first();
                $msg->schedule_start = Carbon::parse($msg->schedule_start)->format('d/m/Y H:i');
                $msg->schedule_end = Carbon::parse($msg->schedule_end)->format('d/m/Y H:i');
            }
            elseif ($request->_type == 'store'){
                try {
                    if (Schedule::create([
                        'schedule_subject' => $request->schedule_subject,
                        'schedule_level' => $request->schedule_level,
                        'schedule_major' => $request->schedule_major,
                        'schedule_start' => Carbon::createFromFormat('d/m/Y H:i', $request->schedule_start)->format('Y-m-d H:i:s'),
                        'schedule_end' => Carbon::createFromFormat('d/m/Y H:i', $request->schedule_end)->format('Y-m-d H:i:s'),
                        'schedule_token' => $request->schedule_token,
                        'schedule_link' => $request->schedule_link,
                        'schedule_monitoring' => $request->schedule_monitoring,

                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Jadwal berhasil di simpan.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    if (Schedule::where('schedule_id', $request->schedule_id)->update([
                        'schedule_subject' => $request->schedule_subject,
                        'schedule_level' => $request->schedule_level,
                        'schedule_major' => $request->schedule_major,
                        'schedule_start' => Carbon::createFromFormat('d/m/Y H:i', $request->schedule_start)->format('Y-m-d H:i:s'),
                        'schedule_end' => Carbon::createFromFormat('d/m/Y H:i', $request->schedule_end)->format('Y-m-d H:i:s'),
                        'schedule_token' => $request->schedule_token,
                        'schedule_link' => $request->schedule_link,
                        'schedule_monitoring' => $request->schedule_monitoring,
                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Jadwal berhasil diperbarui.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $schedule = Schedule::find($request->schedule_id);
                    if ($schedule->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Jadwal berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('exam.backend.schedule', $this->data);
        }
    }

    public function monitoring($class_id, $schedule_id, Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all') {
                $no = 1;
                $students = Student::where('student_class', $class_id)->orderBy('student_class', 'DESC')->orderBy('student_name')->get();
                foreach ($students as $student) {
                    $data[] = [
                        $no++,
                        $student->student_number,
                        $student->student_name,
                        $student->classes->class_name,
                        Arr::has(json_decode($student->student_schedule, true), $schedule_id)?  '<span class="text-success">Mengerjakan</span>' : '<span class="text-danger">Belum Mengerjakan</span>',
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            return response()->json($msg);
        }
        else {
            $this->data['class_id'] = $class_id;
            $this->data['schedule_id'] = $schedule_id;
            return view('exam.backend.monitoring', $this->data);
        }
    }

    public function user(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (User::orderBy('user_fullname')->get() as $user){
                    $data[] = [
                        $no++,
                        $user->user_fullname,
                        $user->role->role_name,
                        $user->user_name,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$user->user_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$user->user_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'user'){
                $msg = User::where('user_id', $request->user_id)->first();
            }
            if ($request->_type == 'select' && $request->_data == 'teacher') {
                $teachers = User::where('user_role', $request->_role)->get();
                foreach ($teachers as $teacher) {
                    $msg[] = ['id' => $teacher->user_id, 'text' => $teacher->user_fullname];
                }
            }
            elseif ($request->_type == 'store'){
                try {
                    if (User::create([
                        'user_fullname' => $request->user_fullname,
                        'user_name' => $request->user_name,
                        'user_pass' => Hash::make($request->user_pass),
                        'user_role' => $request->user_role

                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Pengguna berhasil di simpan.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    if (User::where('user_id', $request->user_id)->update([
                        'user_fullname' => $request->user_fullname,
                        'user_name' => $request->user_name,
                        'user_pass' => $request->user_pass != '' ? Hash::make($request->user_pass) : '',
                        'user_role' => $request->user_role
                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Kelas berhasil diperbarui.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $user = User::find($request->user_id);
                    if ($user->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Pengguna berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('exam.backend.user', $this->data);
        }
    }

    public function setting(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'update' && $request->_data == 'app'){
                $setting = $this->data['setting'];
                if ($request->hasFile('school_logo')) {
                    $file = $request->file('school_logo');
                    Storage::delete('/public/exam/images/'. $setting->value('school_logo'));
                    $file->store('public/exam/images');
                    $school_logo = $file->hashName();
                }
                else {
                    $school_logo = $setting->value('school_logo');
                }
                try {
                    $setting->where('setting_name', 'app_name')->update(['setting_value' => $request->app_name]);
                    $setting->where('setting_name', 'app_alias')->update(['setting_value' => $request->app_alias]);
                    $setting->where('setting_name', 'school_logo')->update(['setting_value' => $school_logo]);
                    $setting->where('setting_name', 'school_name')->update(['setting_value' => $request->school_name]);
                    $setting->where('setting_name', 'school_address')->update(['setting_value' => $request->school_address]);
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
                            Subject::truncate();
                            break;
                        case 2:
                            Level::truncate();
                            break;
                        case 3:
                            Major::truncate();
                            break;
                        case 4:
                            Classes::truncate();
                            break;
                        case 5:
                            Student::truncate();
                            break;
                        case 6:
                            Schedule::truncate();
                            break;
                        case 7:
                            User::truncate();
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
            return view('exam.backend.setting', $this->data);
        }
    }

    public function test()
    {
        $student = Student::find(1);
        $schedule = Arr::add(json_decode($student->student_schedule, true), 2, [1, Carbon::now()->format('d/m/Y H:i:s')]);
        $student->update(['student_schedule' => $schedule]);

        $student = Student::where('student_id', 1)->first();
        $array = json_decode($student->student_schedule, true);
        return response()->json($array);
    }
}
