<?php

namespace App\Http\Controllers\Simadu;

use App\Http\Controllers\Controller;
use App\Models\Master\School;
use App\Models\Master\Student;
use App\Models\Master\Year;
use App\Models\Student\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Matrix\Exception;

class MainController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['school'] = School::first();
        $this->data['setting'] = new Setting();
    }

    public function home(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'submit' && $request->_data == 'lack'){
                $student = Student::where('student_nisn', $request->student_nisn);
                try {
                    if ($student->count() == 1){
                        $student = Student::find($student->value('student_id'));
                        $class = $student->classes()->where('class_year', Year::active())->value('class_alias');
                        $lacks = $student->lack()->get();
                        $lack = 0;
                        foreach ($lacks as $item){
                            $lack = $lack + $item->lack_cost;
                        }
                        $lack = $lack == 0 ? "LUNAS" : "Rp. ". number_format($lack);
                        $msg = ['status' => 1, 'data' => ['student_name' => $student->student_name, 'student_class' => $class, 'student_lack' => $lack]];
                    }
                }catch (\Exception $e){
                    $msg = ['status' => 0, 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else{
            return view('simadu.home', $this->data);
        }
    }

    public function data(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $students = Student::with('classes')->whereHas('classes', function ($q){
                    $q->where('class_year', Year::active());
                })->get();
                $no = 1;
                foreach ($students as $student){
                    $data[] = [
                        $no++,
                        $student->student_name,
                        $student->student_nisn,
                        $student->student_nism,
                        $student->classes[0]->class_alias,
                        $student->student_gender == 1 ? 'Laki-laki' : 'Perempuan',
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            return response()->json($msg);
        }
        else {
            return view('simadu.data', $this->data);
        }
    }

    public function profile(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'update' && $request->_data == 'parent'){
                $other_detail = [
                    'student_kk_no'         => 'required|min:16|max:16',
                    'student_head_family'   => 'required|string',
                ];
                $father_detail = [
                    'student_father_name'   => 'required',
                    'student_father_status' => 'required',
                    'student_father_civic' => 'required',
                    'student_father_nik' => 'required|min:16|max:16',
                    'student_father_birthplace' => 'required',
                    'student_father_birthday' => 'required',
                    'student_father_study' => 'required',
                    'student_father_job' => 'required',
                    'student_father_earning' => 'required',
                    'student_father_phone' => 'required',
                ];
                $mother_detail = [
                    'student_mother_name'   => 'required',
                    'student_mother_status' => 'required',
                    'student_mother_civic' => 'required',
                    'student_mother_nik' => 'required|min:16|max:16',
                    'student_mother_birthplace' => 'required',
                    'student_mother_birthday' => 'required',
                    'student_mother_study' => 'required',
                    'student_mother_job' => 'required',
                    'student_mother_earning' => 'required',
                    'student_mother_phone' => 'required',
                ];
                $regent_detail = [
                    'student_regent_name'   => 'required',
                    'student_regent_status' => 'required',
                    'student_regent_civic' => 'required',
                    'student_regent_nik' => 'required|min:16|max:16',
                    'student_regent_birthplace' => 'required',
                    'student_regent_birthday' => 'required',
                    'student_regent_study' => 'required',
                    'student_regent_job' => 'required',
                    'student_regent_earning' => 'required',
                    'student_regent_phone' => 'required',
                ];
                $home_detail = [
                    'student_home_owner' => 'required',
                    'student_home_address' => 'required',
                    'student_home_postal' => 'required',
                    'student_home_province' => 'required',
                    'student_home_distric' => 'required',
                    'student_home_subdistric' => 'required',
                    'student_home_village' => 'required',
                ];
                $message_detail = [
                    'student_kk_no.required'                => 'Kolom Nomor KK tidak boleh kosong.',
                    'student_kk_no.min'                     => 'Jumlah Nomor KK harus 16 digit.',
                    'student_kk_no.max'                     => 'Jumlah Nomor KK harus 16 digit.',
                    'student_head_family.required'          => 'Kolom Kepala Keluarga tidak boleh kosong.',
                    'student_father_name.required'          => 'Kolom Nama Ayah tidak boleh kosong.',
                    'student_father_status.required'        => 'Kolom Status Ayah tidak boleh kosong.',
                    'student_father_civic.required'         => 'Kolom Kewarganegaraan Ayah tidak boleh kosong.',
                    'student_father_nik.required'           => 'Kolom NIK Ayah tidak boleh kosong.',
                    'student_father_nik.min'                => 'Jumlah NIK harus 16 digit.',
                    'student_father_nik.max'                => 'Jumlah NIK harus 16 digit.',
                    'student_father_birthplace.required'    => 'Kolom Tempat Lahir Ayah tidak boleh kosong.',
                    'student_father_birthday.required'      => 'Kolom Tanggal Lahir Ayah tidak boleh kosong.',
                    'student_father_study.required'         => 'Kolom Pendidikan Ayah tidak boleh kosong.',
                    'student_father_job.required'           => 'Kolom Pekerjaan Ayah tidak boleh kosong.',
                    'student_father_earning.required'       => 'Kolom Pengahasilan Ayah tidak boleh kosong.',
                    'student_father_phone.required'         => 'Kolom Nomor Telepon Ayah tidak boleh kosong.',
                    'student_mother_name.required'          => 'Kolom Nama Ibu tidak boleh kosong.',
                    'student_mother_status.required'        => 'Kolom Status Ibu tidak boleh kosong.',
                    'student_mother_civic.required'         => 'Kolom Kewarganegaraan Ibu tidak boleh kosong.',
                    'student_mother_nik.required'           => 'Kolom NIK Ibu tidak boleh kosong.',
                    'student_mother_nik.min'                => 'Jumlah NIK harus 16 digit.',
                    'student_mother_nik.max'                => 'Jumlah NIK harus 16 digit.',
                    'student_mother_birthplace.required'    => 'Kolom Tempat Lahir Ibu tidak boleh kosong.',
                    'student_mother_birthday.required'      => 'Kolom Tanggal Lahir Ibu tidak boleh kosong.',
                    'student_mother_study.required'         => 'Kolom Pendidikan Ibu tidak boleh kosong.',
                    'student_mother_job.required'           => 'Kolom Pekerjaan Ibu tidak boleh kosong.',
                    'student_mother_earning.required'       => 'Kolom Pengahasilan Ibu tidak boleh kosong.',
                    'student_mother_phone.required'         => 'Kolom Nomor Telepon Ibu tidak boleh kosong.',
                    'student_regent_name.required'          => 'Kolom Nama Wali tidak boleh kosong.',
                    'student_regent_status.required'        => 'Kolom Status Wali tidak boleh kosong.',
                    'student_regent_civic.required'         => 'Kolom Kewarganegaraan Wali tidak boleh kosong.',
                    'student_regent_nik.required'           => 'Kolom NIK Wali tidak boleh kosong.',
                    'student_regent_nik.min'                => 'Jumlah NIK harus 16 digit.',
                    'student_regent_nik.max'                => 'Jumlah NIK harus 16 digit.',
                    'student_regent_birthplace.required'    => 'Kolom Tempat Lahir Wali tidak boleh kosong.',
                    'student_regent_birthday.required'      => 'Kolom Tanggal Lahir Wali tidak boleh kosong.',
                    'student_regent_study.required'         => 'Kolom Pendidikan Wali tidak boleh kosong.',
                    'student_regent_job.required'           => 'Kolom Pekerjaan Wali tidak boleh kosong.',
                    'student_regent_earning.required'       => 'Kolom Pengahasilan Wali tidak boleh kosong.',
                    'student_regent_phone.required'         => 'Kolom Nomor Telepon Wali tidak boleh kosong.',
                ];
                try {
                    if ($request->student_father_status != 1){
                        $validator = Validator::make($request->all(),
                            array_merge($other_detail, $mother_detail, $regent_detail, $home_detail), $message_detail);
                    }
                    elseif ($request->student_mother_status != 1){
                        $validator = Validator::make($request->all(),
                            array_merge($other_detail, $father_detail, $regent_detail, $home_detail), $message_detail);
                    }
                    else {
                        $validator = Validator::make($request->all(),
                            array_merge($other_detail, $father_detail, $mother_detail, $regent_detail, $home_detail), $message_detail);
                    }
                    if ($validator->fails()) {
                        throw new Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $parent = Student::find($request->student_id);
                        $parent->student_kk_no = $request->student_kk_no;
                        $parent->student_head_family = $request->student_head_family;
                        $parent->student_father_name   = $request->student_father_name;
                        $parent->student_father_status = $request->student_father_status;
                        $parent->student_father_civic = $request->student_father_civic;
                        $parent->student_father_nik = $request->student_father_nik;
                        $parent->student_father_birthplace = $request->student_father_birthplace;
                        $parent->student_father_birthday = Carbon::createFromFormat('d/m/Y', $request->student_father_birthday)->format('Y-m-d');
                        $parent->student_father_study = $request->student_father_study;
                        $parent->student_father_job = $request->student_father_job;
                        $parent->student_father_earning = $request->student_father_earning;
                        $parent->student_father_phone = $request->student_father_phone;
                        $parent->student_mother_name   = $request->student_mother_name;
                        $parent->student_mother_status = $request->student_mother_status;
                        $parent->student_mother_civic = $request->student_mother_civic;
                        $parent->student_mother_nik = $request->student_mother_nik;
                        $parent->student_mother_birthplace = $request->student_mother_birthplace;
                        $parent->student_mother_birthday = Carbon::createFromFormat('d/m/Y', $request->student_mother_birthday)->format('Y-m-d');
                        $parent->student_mother_study = $request->student_mother_study;
                        $parent->student_mother_job = $request->student_mother_job;
                        $parent->student_mother_earning = $request->student_mother_earning;
                        $parent->student_mother_phone = $request->student_mother_phone;
                        $parent->student_regent_name   = $request->student_regent_name;
                        $parent->student_regent_status = $request->student_regent_status;
                        $parent->student_regent_civic = $request->student_regent_civic;
                        $parent->student_regent_nik = $request->student_regent_nik;
                        $parent->student_regent_birthplace = $request->student_regent_birthplace;
                        $parent->student_regent_birthday = Carbon::createFromFormat('d/m/Y', $request->student_regent_birthday)->format('Y-m-d');
                        $parent->student_regent_study = $request->student_regent_study;
                        $parent->student_regent_job = $request->student_regent_job;
                        $parent->student_regent_earning = $request->student_regent_earning;
                        $parent->student_regent_phone = $request->student_regent_phone;
                        $parent->student_home_owner = $request->student_home_owner ;
                        $parent->student_home_address = $request->student_home_address ;
                        $parent->student_home_postal = $request->student_home_postal ;
                        $parent->student_home_province = $request->student_home_province ;
                        $parent->student_home_distric = $request->student_home_distric ;
                        $parent->student_home_subdistric = $request->student_home_subdistric ;
                        $parent->student_home_village = $request->student_home_village ;
                        if ($parent->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data orang tua berhasil di perbarui.'];
                        }
                    }
                }
                catch (Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            $this->data['student'] = Student::find(Session::get('simadu.auth')->student_id);
            return view('simadu.profile', $this->data);
        }
    }
}
