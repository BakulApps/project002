<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Models\Admission\Cost;
use App\Models\Admission\Form;
use App\Models\Admission\Invoice;
use App\Models\Admission\Payment;
use App\Models\Admission\Setting;
use App\Models\Admission\Student;
use App\Models\Admission\User;
use App\Models\Master\Civic;
use App\Models\Master\Distance;
use App\Models\Master\Earning;
use App\Models\Master\Gender;
use App\Models\Master\Job;
use App\Models\Master\Religion;
use App\Models\Master\School;
use App\Models\Master\Study;
use App\Models\Master\Territory;
use App\Models\Master\Transport;
use App\Models\Master\Travel;
use App\Models\Student\Hobby;
use App\Models\Student\ParentStatus;
use App\Models\Student\Program;
use App\Models\Student\Purpose;
use App\Models\Student\Residence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
                if ($request->program_id != null && $request->boarding_id != null) {
                    $students =  Student::where('student_boarding', $request->boarding_id)
                        ->where('student_program', $request->program_id)
                        ->orderBy('student_id', 'DESC')->get();
                }
                elseif ($request->program_id != null) {
                    $students =  Student::where('student_program', $request->program_id)
                        ->orderBy('student_id', 'DESC')->get();
                }
                elseif ($request->boarding_id != null) {
                    $students =  Student::where('student_boarding', $request->boarding_id)
                        ->orderBy('student_id', 'DESC')->get();
                }
                else {
                    $students = Student::orderBy('student_id', 'DESC')->get();
                }
                $no = 1;
                foreach ($students as $student) {
                    $data[] = [
                        $no++,
                        $student->student_name,
                        $student->student_nisn,
                        $student->student_nik,
                        $student->student_birthplace .", ". Carbon::parse($student->student_birthday)->translatedFormat('d F Y'),
                        $student->address(),
                        $student->student_guard_name,
                        Carbon::create($student->created_at)->format('d/m/Y'),
                        '<div class="btn-group">
                            <form method="post" action="'.route('admission.register').'">
                                <input type="hidden" name="_type" value="print">
                                <input type="hidden" name="_data" value="'.$student->student_id.'">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <button type="submit" class="btn btn-outline-primary bt-sm" data-num="'. $student->student_id .'"><i class="icon-printer"></i></button>
                            </form>
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'. $student->student_id .'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="' . $student->student_id . '"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'store'){
                try {
                    if ($request->student_nisn != null && Student::where('student_nisn', $request->student_nisn)->count() >= 1){
                        throw new \Exception('NISN telah terdaftar, silahkan periksa kembali NISN.');
                    }
                    elseif (Student::where('student_nik', $request->student_nik)->count() >= 1){
                        throw new \Exception('NIK telah terdaftar, silahkan periksa kembali NIK.');
                    }
                    else {
                        $form = [
                            'student_name'          => 'required|max:200',
                            'student_nisn'          => 'nullable|min:10|max:10',
                            'student_nik'           => 'required|min:16|max:16',
                            'student_birthplace'    => 'required',
                            'student_birthday'      => 'required|date_format:d/m/Y',
                            'student_gender'        => 'required',
                            'student_religion'      => 'required',
                            'student_siblingplace'  => 'required',
                            'student_sibling'       => 'required',
                            'student_civic'         => 'required',
                            'student_hobby'         => 'required',
                            'student_purpose'       => 'required',
                            'student_email'         => 'required',
                            'student_phone'         => 'required',
                            'student_residence'     => 'required',
                            'student_address'       => 'required|max:200',
                            'student_province'      => 'required',
                            'student_distric'       => 'required',
                            'student_subdistric'    => 'required',
                            'student_village'       => 'required',
                            'student_distance'      => 'required',
                            'student_transport'     => 'required',
                            'student_travel'        => 'required',
                            'student_program'       => 'required',
                            'student_no_kk'         => 'required|min:16|max:16',
                            'student_head_family'   => 'required',
                            'student_guard_name'   => 'required',
                            'student_guard_birthplace' => 'required',
                            'student_guard_birthday' => 'required',
                            'student_guard_nik' => 'required|min:16|max:16',
                            'student_guard_study' => 'required',
                            'student_guard_job' => 'required',
                            'student_guard_earning' => 'required',
                            'student_guard_phone' => 'required',
                            'student_home_owner' => 'required',
                            'student_home_address' => 'required',
                            'student_home_postal' => 'required',
                            'student_home_province' => 'required',
                            'student_home_distric' => 'required',
                            'student_home_subdistric' => 'required',
                            'student_home_village' => 'required',
                            'student_school_from' => 'required',
                            'student_school_name' => 'required',
                            'student_school_npsn' => 'required',
                            'student_school_address' => 'required',
                            'student_kip_file' => 'mimes:jpg,jpeg|max:600',
                            'student_pkh_file' => 'mimes:jpg,jpeg|max:600',
                            'student_kks_file' => 'mimes:jpg,jpeg|max:600',
                            'student_swaphoto' => 'mimes:jpg,jpeg|max:600',
                            'student_ktp_photo' => 'mimes:jpg,jpeg|max:600',
                            'student_akta_photo' => 'mimes:jpg,jpeg|max:600',
                            'student_kk_photo' => 'mimes:jpg,jpeg|max:600',
                            'student_ijazah_photo' => 'mimes:jpg,jpeg|max:600',
                            'student_skhun_photo' => 'mimes:jpg,jpeg|max:600',
                        ];
                        if (in_array($request->student_father_status, [2, 3])){
                            $father = [
                                'student_father_name'   => 'nullable',
                                'student_father_birthplace' => 'nullable',
                                'student_father_birthday' => 'nullable',
                                'student_father_status' => 'nullable',
                                'student_father_nik' => 'nullable|min:16|max:16',
                                'student_father_study' => 'nullable',
                                'student_father_job' => 'nullable',
                                'student_father_earning' => 'nullable',
                                'student_father_phone' => 'nullable',
                            ];
                        }
                        else {
                            $father = [
                                'student_father_name'   => 'required',
                                'student_father_birthplace' => 'required',
                                'student_father_birthday' => 'required',
                                'student_father_status' => 'required',
                                'student_father_nik' => 'required|min:16|max:16',
                                'student_father_study' => 'required',
                                'student_father_job' => 'required',
                                'student_father_earning' => 'required',
                                'student_father_phone' => 'required',
                            ];
                        }
                        if (in_array($request->student_mother_status, [2, 3])){
                            $mother = [
                                'student_mother_name'   => 'nullable',
                                'student_mother_birthplace' => 'nullable',
                                'student_mother_birthday' => 'nullable',
                                'student_mother_status' => 'nullable',
                                'student_mother_nik' => 'nullable|min:16|max:16',
                                'student_mother_study' => 'nullable',
                                'student_mother_job' => 'nullable',
                                'student_mother_earning' => 'nullable',
                                'student_mother_phone' => 'nullable',
                            ];
                        }
                        else {
                            $mother = [
                                'student_mother_name'   => 'required',
                                'student_mother_birthplace' => 'required',
                                'student_mother_birthday' => 'required',
                                'student_mother_status' => 'required',
                                'student_mother_nik' => 'required|min:16|max:16',
                                'student_mother_study' => 'required',
                                'student_mother_job' => 'required',
                                'student_mother_earning' => 'required',
                                'student_mother_phone' => 'required',
                            ];
                        }
                        $form = array_merge($form, $father);
                        $form = array_merge($form, $mother);
                        $message = [
                            'student_name.required'          => 'Kolom nama lengkap tidak boleh kosong.',
                            'student_name.max'          => 'Kolom nama lengkap maksimal 200 karakter',
                            'student_nisn.min'          => 'NISN salah, silahkan periksa kembali',
                            'student_nisn.max'          => 'NISN salah, silahkan periksa kembali',
                            'student_nik.required'           => 'Kolom NIK tidak boleh kosong.',
                            'student_nik.min'           => 'NIK salah, silahkan periksa kembali.',
                            'student_nik.max'           => 'NIK salah, silahkan periksa kembali.',
                            'student_birthplace.required'    => 'Kolom tempat lahir tidak boleh kosong.',
                            'student_birthday.required'      => 'Kolom tanggal lahir tidak boleh kosong.',
                            'student_gender.required'        => 'Kolom jenis kelamin tidak boleh kosong, silahkan memilih.',
                            'student_religion.required'      => 'Kolom agama tidak boleh kosong, silahkan memilih.',
                            'student_siblingplace.required'  => 'Kolom anak-ke tidak boleh kosong.',
                            'student_sibling.required'       => 'Kolom jumlah saudara tidak boleh kosong.',
                            'student_civic.required'         => 'Kolom kewarganegaraan tidak boleh kosong, silahkan memilih.',
                            'student_hobby.required'         => 'Kolom hobi tidak boleh kosong, silahkan memilih.',
                            'student_purpose.required'       => 'Kolom cita-cita tidak boleh kosong, silahkan memilih.',
                            'student_email.required'         => 'Kolom email tidak boleh kosong.',
                            'student_phone.required'         => 'Kolom nomor HP tidak boleh kosong.',
                            'student_residence.required'     => 'Kolom jenis tempat tinggak siswa tidak boleh kosong, silahkan memilih.',
                            'student_address.required'       => 'Kolom alamat tidak boleh kosong.',
                            'student_address.max'       => 'Kolom alamat maksimal 200 karakter',
                            'student_province.required'      => 'Kolom propinsi tidak boleh kosong, silahkan memilih.',
                            'student_distric.required'       => 'Kolom kabupaten tidak boleh kosong, silahkan memilih.',
                            'student_subdistric.required'    => 'Kolom kecamatan tidak boleh kosong, silahkan memilih.',
                            'student_village.required'       => 'Kolom kelurahan/desa tidak boleh kosong, silahkan memilih.',
                            'student_distance.required'      => 'Kolom jarak tempat tinggal tidak boleh kosong, silahkan memilih.',
                            'student_transport.required'     => 'Kolom tranportasi yang dipakai tidak boleh kosong, silahkan memilih.',
                            'student_travel.required'        => 'Kolom waktu tempuh tidak boleh kosong, silahkan memilih.',
                            'student_program.required'       => 'Kolom program pilihan tidak boleh kosong, silahkan memilih.',
                            'student_no_kk.required'         => 'Kolom nomor kartu keluarga tidak boleh kosong.',
                            'student_no_kk.min'         => 'Nomor kartu keluarga salah, silahkan periksa kembali.',
                            'student_no_kk.max'         => 'Nomor kartu keluarga salah, silahkan periksa kembali.',
                            'student_head_family.required'   => 'Kolom kepala keluarga tidak boleh kosong.',
                            'student_father_name.required'   => 'Kolom nama ayah kandung tidak boleh kosong.',
                            'student_father_birthplace.required' => 'Kolom tempat lahir ayah tidak boleh kosong.',
                            'student_father_birthday.required' => 'Kolom tanggal lahir ayah tidak boleh kosong.',
                            'student_father_status.required' => 'Kolom status ayah tidak boleh kosong, silahkan memilih.',
                            'student_father_nik.required' => 'Kolom NIK ayah tidak boleh kosong.',
                            'student_father_nik.min' => 'NIK ayah salah, silahkan periksa kembali.',
                            'student_father_nik.max' => 'NIK ayah salah, silahkan periksa kembali.',
                            'student_father_study' => 'Kolom pendidikan ayah tidak boleh kosong, silahkan memilih.',
                            'student_father_job' => 'Kolom pekerjaan ayah tidak boleh kosong, silahkan memilih.',
                            'student_father_earning' => 'Kolom pendapatan ayah tidak boleh kosong, silahkan memilih.',
                            'student_father_phone' => 'Kolom nomor HP ayah tidak boleh kosong',
                            'student_mother_name.required'   => 'Kolom nama ibu kandung tidak boleh kosong.',
                            'student_mother_birthplace.required' => 'Kolom tempat lahir ibu tidak boleh kosong.',
                            'student_mother_birthday.required' => 'Kolom tanggal lahir ibu tidak boleh kosong.',
                            'student_mother_status.required' => 'Kolom status ibu tidak boleh kosong, silahkan memilih.',
                            'student_mother_nik.required' => 'Kolom NIK ibu tidak boleh kosong.',
                            'student_mother_nik.min' => 'NIK ibu salah, silahkan periksa kembali.',
                            'student_mother_nik.max' => 'NIK ibu salah, silahkan periksa kembali.',
                            'student_mother_study' => 'Kolom pendidikan ibu tidak boleh kosong, silahkan memilih.',
                            'student_mother_job' => 'Kolom pekerjaan ibu tidak boleh kosong, silahkan memilih.',
                            'student_mother_earning' => 'Kolom pendapatan ibu tidak boleh kosong, silahkan memilih.',
                            'student_mother_phone' => 'Kolom nomor HP ibu tidak boleh kosong',
                            'student_guard_name.required'   => 'Kolom nama wali kandung tidak boleh kosong.',
                            'student_guard_birthplace.required' => 'Kolom tempat lahir wali tidak boleh kosong.',
                            'student_guard_birthday.required' => 'Kolom tanggal lahir wali tidak boleh kosong.',
                            'student_guard_nik.required' => 'Kolom NIK wali tidak boleh kosong.',
                            'student_guard_nik.min' => 'NIK wali salah, silahkan periksa kembali.',
                            'student_guard_nik.max' => 'NIK wali salah, silahkan periksa kembali.',
                            'student_guard_study.required' => 'Kolom pendidikan wali tidak boleh kosong, silahkan memilih.',
                            'student_guard_job.required' => 'Kolom pekerjaan wali tidak boleh kosong, silahkan memilih.',
                            'student_guard_earning.required' => 'Kolom pendapatan wali tidak boleh kosong, silahkan memilih.',
                            'student_guard_phone.required' => 'Kolom nomor HP wali tidak boleh kosong.',
                            'student_home_owner.required' => 'Kolom status kepemilikan rumah tidak boleh kosong, silahkan memilih.',
                            'student_home_address.required' => 'Kolom alamat rumah orangtua tidak boleh kosong.',
                            'student_home_postal.required' => 'Kolom kodepos rumah orangtua tidak boleh kosong.',
                            'student_home_province.required' => 'Kolom propinsi rumah orangtua tidak boleh kosong, silahkan memilih.',
                            'student_home_distric.required' => 'Kolom kabupaten rumah orangtua tidak boleh kosong, silahkan memilih.',
                            'student_home_subdistric.required' => 'Kolom kecamatan rumah orangtua tidak boleh kosong, silahkan memilih.',
                            'student_home_village.required' => 'Kolom kelurahan/desa rumah orangtua tidak boleh kosong, silahkan memilih.',
                            'student_school_from.required' => 'Kolom jenis sekolah asal tidak boleh kosong.',
                            'student_school_name.required' => 'Kolom nama sekolah asal tidak boleh kosong',
                            'student_school_address.required' => 'Kolom alamat sekolah asal tidak boleh kosong.',
                            'student_kip_file.mimes' => ' Gambar swafoto harus berformat jpg/jpeg.',
                            'student_kip_file.max' => 'Ukuran gambar swafoto maksimal 512Kb',
                            'student_pkh.mimes' => ' Gambar swafoto harus berformat jpg/jpeg.',
                            'student_pkh.max' => 'Ukuran gambar swafoto maksimal 512Kb',
                            'student_kks.mimes' => ' Gambar swafoto harus berformat jpg/jpeg.',
                            'student_kks.max' => 'Ukuran gambar swafoto maksimal 512Kb',
                            'student_swaphoto.mimes' => ' Gambar swafoto harus berformat jpg/jpeg.',
                            'student_swaphoto.max' => 'Ukuran gambar swafoto maksimal 512Kb',
                            'student_ktp_photo.mimes' => ' Gambar KTP harus berformat jpg/jpeg.',
                            'student_ktp_photo.max' => 'Ukuran gambar KTP maksimal 512Kb',
                            'student_akta_photo.mimes' => ' Gambar akta kelahiran harus berformat jpg/jpeg.',
                            'student_akta_photo.max' => 'Ukuran gambar akta kelahiran maksimal 512Kb',
                            'student_kk_photo.mimes' => ' Gambar kartu keluarga harus berformat jpg/jpeg.',
                            'student_kk_photo.max' => 'Ukuran gambar kartu kelahiran maksimal 512Kb',
                            'student_ijazah_photo.mimes' => ' Gambar ijazah harus berformat jpg/jpeg.',
                            'student_ijazah_photo.max' => 'Ukuran gambar ijazah maksimal 512Kb',
                            'student_skhun_photo.mimes' => ' Gambar SKHUN/SKL harus berformat jpg/jpeg.',
                            'student_skhun_photo.max' => 'Ukuran gambar SKHUN/SKL maksimal 512Kb',
                            'student_sholarship_photo.mimes' => ' Gambar Kartu Bantuan harus berformat jpg/jpeg.',
                            'student_sholarship_photo.max' => 'Ukuran gambar Kartu Bantuan maksimal 512Kb',
                        ];

                        $validator = Validator::make($request->all(), $form, $message);
                        if ($validator->fails()){
                            throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                        }
                        else {
                            $student = new Student();
                            $student->student_name          = $request->student_name;
                            $student->student_nisn          = $request->student_nisn;
                            $student->student_nik           = $request->student_nik;
                            $student->student_birthplace    = $request->student_birthplace;
                            $student->student_birthday      = Carbon::createFromFormat('d/m/Y', $request->student_birthday)->format('Y-m-d');
                            $student->student_gender        = $request->student_gender;
                            $student->student_religion      = $request->student_religion;
                            $student->student_siblingplace  = $request->student_siblingplace;
                            $student->student_sibling       = $request->student_sibling;
                            $student->student_civic         = $request->student_civic;
                            $student->student_hobby         = $request->student_hobby;
                            $student->student_purpose       = $request->student_purpose;
                            $student->student_email       = $request->student_email;
                            $student->student_phone       = $request->student_phone;
                            $student->student_residence     = $request->student_residence;
                            $student->student_address       = $request->student_address;
                            $student->student_province      = $request->student_province;
                            $student->student_distric       = $request->student_distric;
                            $student->student_subdistric    = $request->student_subdistric;
                            $student->student_village       = $request->student_village;
                            $student->student_postal        = $request->student_postal;
                            $student->student_distance      = $request->student_distance;
                            $student->student_transport     = $request->student_transport;
                            $student->student_travel        = $request->student_travel;
                            $student->student_program       = $request->student_program;
                            $student->student_boarding       = $request->student_boarding;
                            $student->student_im_hepatitis  = $request->student_im_hepatitis;
                            $student->student_im_polio      = $request->student_im_polio;
                            $student->student_im_bcg        = $request->student_im_bcg;
                            $student->student_im_campak     = $request->student_im_campak;
                            $student->student_im_dpt        = $request->student_im_dpt;
                            $student->student_im_covid        = $request->student_im_covid;
                            $student->student_no_kk         = $request->student_no_kk;
                            $student->student_head_family   = $request->student_head_family;
                            $student->student_father_name   = $request->student_father_name;
                            $student->student_mother_name   = $request->student_mother_name;
                            $student->student_father_birthplace   = $request->student_father_birthplace;
                            $student->student_mother_birthplace   = $request->student_mother_birthplace;
                            $student->student_father_birthday = Carbon::createFromFormat('d/m/Y', $request->student_father_birthday)->format('Y-m-d');
                            $student->student_mother_birthday = Carbon::createFromFormat('d/m/Y', $request->student_mother_birthday)->format('Y-m-d');
                            $student->student_father_status = $request->student_father_status;
                            $student->student_mother_status = $request->student_mother_status;
                            $student->student_father_nik = $request->student_father_nik;
                            $student->student_mother_nik = $request->student_mother_nik;
                            $student->student_father_study = $request->student_father_study;
                            $student->student_mother_study = $request->student_mother_study;
                            $student->student_father_job = $request->student_father_job;
                            $student->student_mother_job = $request->student_mother_job;
                            $student->student_father_earning = $request->student_father_earning;
                            $student->student_mother_earning = $request->student_mother_earning;
                            $student->student_father_phone = $request->student_father_phone;
                            $student->student_mother_phone = $request->student_mother_phone;
                            $student->student_guard_name   = $request->student_guard_name;
                            $student->student_guard_birthplace   = $request->student_guard_birthplace;
                            $student->student_guard_birthday = Carbon::createFromFormat('d/m/Y', $request->student_guard_birthday)->format('Y-m-d');
                            $student->student_guard_nik = $request->student_guard_nik;
                            $student->student_guard_study = $request->student_guard_study;
                            $student->student_guard_job = $request->student_guard_job;
                            $student->student_guard_earning = $request->student_guard_earning;
                            $student->student_guard_phone = $request->student_guard_phone;
                            $student->student_home_owner = $request->student_home_owner;
                            $student->student_home_address = $request->student_home_address;
                            $student->student_home_postal = $request->student_home_postal;
                            $student->student_home_province = $request->student_home_province;
                            $student->student_home_distric = $request->student_home_distric;
                            $student->student_home_subdistric = $request->student_home_subdistric;
                            $student->student_home_village = $request->student_home_village;
                            $student->student_kip_no = $request->student_kip_no;
                            $student->student_pkh_no = $request->student_pkh_no;
                            $student->student_kks_no = $request->student_kks_no;
                            $student->student_school_from = $request->student_school_from;
                            $student->student_school_name = $request->student_school_name;
                            $student->student_school_npsn = $request->student_school_npsn;
                            $student->student_school_address = $request->student_school_address;
                            $path = storage_path('app/public/admission/fronted/images/student/');
                            if ($request->hasFile('student_kip_file')){
                                $request->file('student_kip_file')->move($path , $student->student_nik .'_kip_file.jpg');
                                $student->student_kip_file = 1;
                            }
                            if ($request->hasFile('student_pkh_file')){
                                $request->file('student_pkh_file')->move($path , $student->student_nik .'_pkh_file.jpg');
                                $student->student_pkh_file = 1;
                            }
                            if ($request->hasFile('student_kks_file')){
                                $request->file('student_kks_file')->move($path , $student->student_nik .'_kks_file.jpg');
                                $student->student_kks_file = 1;
                            }
                            if ($request->hasFile('student_swaphoto')){
                                $request->file('student_swaphoto')->move($path , $student->student_nik .'_swaphoto.jpg');
                                $student->student_swaphoto = 1;
                            }
                            if ($request->hasFile('student_ktp_photo')){
                                $request->file('student_ktp_photo')->move($path , $student->student_nik .'_ktp.jpg');
                                $student->student_ktp_photo = 1;
                            }
                            if ($request->hasFile('student_akta_photo')){
                                $request->file('student_akta_photo')->move($path , $student->student_nik .'_akta.jpg');
                                $student->student_akta_photo = 1;
                            }
                            if ($request->hasFile('student_kk_photo')){
                                $request->file('student_kk_photo')->move($path , $student->student_nik .'_kk.jpg');
                                $student->student_kk_photo = 1;
                            }
                            if ($request->hasFile('student_ijazah_photo')){
                                $request->file('student_ijazah_photo')->move($path , $student->student_nik .'_ijazah.jpg');
                                $student->student_ijazah_photo = 1;
                            }
                            if ($request->hasFile('student_skhun_photo')){
                                $request->file('student_skhun_photo')->move($path , $student->student_nik .'_skhun.jpg');
                                $student->student_skhun_photo = 1;
                            }
                            if ($student->save()) {
                                $number_form        = Form::latest('form_letter')->first() == null ? 1 : Form::latest('form_letter')->first()->form_id + 1;
                                $month              = ['01' => 'I', '02' => 'II', '03' => 'III', '04' => 'IV', '05' => "V", '06' => 'VI', '07' => 'VII', '08' => 'VIII', '09' => 'IX', '10' => 'X', '11' => 'XI', '12' =>'XII'];
                                $now                = Carbon::now();
                                $form               = new Form();
                                $form->form_uuid    = Str::uuid();
                                $form->form_letter  = sprintf("%04s", $number_form) . '/PPDB.'.$this->data['school']->school_nickname.'/PP.006/'.$month[$now->format('m')].'/'.$now->format('Y');
                                $form->form_student = $student->student_id;
                                $form->form_date    = Carbon::now()->format('Y-m-d');
                                $form->form_count   = 0;
                                $form->save();
                                $path = storage_path('app/public/admission/fronted/images/student/' . $student->student_nik . '_qrcode.png');
                                QrCode::size(110)
                                    ->format('png')->generate(route('admission.authenticate', $form->form_uuid), $path);
                                $cost = Cost::where('cost_program', $student->student_program)->where('cost_boarding', $student->student_boarding)->where('cost_gender', $request->student_gender)->first();
                                $invoice = new Invoice();
                                $invoice->invoice_student = $student->student_id;
                                $invoice->invoice_amount = $cost->cost_amount;
                                $invoice->invoice_status = 1;
                                $invoice->save();
                                $msg = ['title' => 'Berhasil !', 'class' => 'success', 'text' => 'Pendaftaran berhasil, silahkan mencetak bukti pendaftaran.'];
                            }
                        }
                    }
                }
                catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
                return $msg;
            }
            elseif ($request->_type == 'update'){
                $form = [
                    'student_name'          => 'required|max:200',
                    'student_nisn'          => 'nullable|min:10|max:10',
                    'student_nik'           => 'required|min:16|max:16',
                    'student_birthplace'    => 'required',
                    'student_birthday'      => 'required|date_format:d/m/Y',
                    'student_gender'        => 'required',
                    'student_religion'      => 'required',
                    'student_siblingplace'  => 'required',
                    'student_sibling'       => 'required',
                    'student_civic'         => 'required',
                    'student_hobby'         => 'required',
                    'student_purpose'       => 'required',
                    'student_email'         => 'required',
                    'student_phone'         => 'required',
                    'student_residence'     => 'required',
                    'student_address'       => 'required|max:200',
                    'student_province'      => 'required',
                    'student_distric'       => 'required',
                    'student_subdistric'    => 'required',
                    'student_village'       => 'required',
                    'student_distance'      => 'required',
                    'student_transport'     => 'required',
                    'student_travel'        => 'required',
                    'student_program'       => 'required',
                    'student_no_kk'         => 'required|min:16|max:16',
                    'student_head_family'   => 'required',
                    'student_guard_name'   => 'required',
                    'student_guard_birthplace' => 'required',
                    'student_guard_birthday' => 'required',
                    'student_guard_nik' => 'required|min:16|max:16',
                    'student_guard_study' => 'required',
                    'student_guard_job' => 'required',
                    'student_guard_earning' => 'required',
                    'student_guard_phone' => 'required',
                    'student_home_owner' => 'required',
                    'student_home_address' => 'required',
                    'student_home_postal' => 'required',
                    'student_home_province' => 'required',
                    'student_home_distric' => 'required',
                    'student_home_subdistric' => 'required',
                    'student_home_village' => 'required',
                    'student_school_from' => 'required',
                    'student_school_name' => 'required',
                    'student_school_npsn' => 'required',
                    'student_school_address' => 'required',
                ];
                if (in_array($request->student_father_status, [2, 3])){
                    $father = [
                        'student_father_name'   => 'nullable',
                        'student_father_birthplace' => 'nullable',
                        'student_father_birthday' => 'nullable',
                        'student_father_status' => 'nullable',
                        'student_father_nik' => 'nullable|min:16|max:16',
                        'student_father_study' => 'nullable',
                        'student_father_job' => 'nullable',
                        'student_father_earning' => 'nullable',
                        'student_father_phone' => 'nullable',
                    ];
                }
                else {
                    $father = [
                        'student_father_name'   => 'required',
                        'student_father_birthplace' => 'required',
                        'student_father_birthday' => 'required',
                        'student_father_status' => 'required',
                        'student_father_nik' => 'required|min:16|max:16',
                        'student_father_study' => 'required',
                        'student_father_job' => 'required',
                        'student_father_earning' => 'required',
                        'student_father_phone' => 'required',
                    ];
                }
                if (in_array($request->student_mother_status, [2, 3])){
                    $mother = [
                        'student_mother_name'   => 'nullable',
                        'student_mother_birthplace' => 'nullable',
                        'student_mother_birthday' => 'nullable',
                        'student_mother_status' => 'nullable',
                        'student_mother_nik' => 'nullable|min:16|max:16',
                        'student_mother_study' => 'nullable',
                        'student_mother_job' => 'nullable',
                        'student_mother_earning' => 'nullable',
                        'student_mother_phone' => 'nullable',
                    ];
                }
                else {
                    $mother = [
                        'student_mother_name'   => 'required',
                        'student_mother_birthplace' => 'required',
                        'student_mother_birthday' => 'required',
                        'student_mother_status' => 'required',
                        'student_mother_nik' => 'required|min:16|max:16',
                        'student_mother_study' => 'required',
                        'student_mother_job' => 'required',
                        'student_mother_earning' => 'required',
                        'student_mother_phone' => 'required',
                    ];
                }
                $form = array_merge($form, $father);
                $form = array_merge($form, $mother);
                $message = [
                    'student_name.required'          => 'Kolom nama lengkap tidak boleh kosong.',
                    'student_name.max'          => 'Kolom nama lengkap maksimal 200 karakter',
                    'student_nisn.min'          => 'NISN salah, silahkan periksa kembali',
                    'student_nisn.max'          => 'NISN salah, silahkan periksa kembali',
                    'student_nik.required'           => 'Kolom NIK tidak boleh kosong.',
                    'student_nik.min'           => 'NIK salah, silahkan periksa kembali.',
                    'student_nik.max'           => 'NIK salah, silahkan periksa kembali.',
                    'student_birthplace.required'    => 'Kolom tempat lahir tidak boleh kosong.',
                    'student_birthday.required'      => 'Kolom tanggal lahir tidak boleh kosong.',
                    'student_gender.required'        => 'Kolom jenis kelamin tidak boleh kosong, silahkan memilih.',
                    'student_religion.required'      => 'Kolom agama tidak boleh kosong, silahkan memilih.',
                    'student_siblingplace.required'  => 'Kolom anak-ke tidak boleh kosong.',
                    'student_sibling.required'       => 'Kolom jumlah saudara tidak boleh kosong.',
                    'student_civic.required'         => 'Kolom kewarganegaraan tidak boleh kosong, silahkan memilih.',
                    'student_hobby.required'         => 'Kolom hobi tidak boleh kosong, silahkan memilih.',
                    'student_purpose.required'       => 'Kolom cita-cita tidak boleh kosong, silahkan memilih.',
                    'student_email.required'         => 'Kolom email tidak boleh kosong.',
                    'student_phone.required'         => 'Kolom nomor HP tidak boleh kosong.',
                    'student_residence.required'     => 'Kolom jenis tempat tinggak siswa tidak boleh kosong, silahkan memilih.',
                    'student_address.required'       => 'Kolom alamat tidak boleh kosong.',
                    'student_address.max'       => 'Kolom alamat maksimal 200 karakter',
                    'student_province.required'      => 'Kolom propinsi tidak boleh kosong, silahkan memilih.',
                    'student_distric.required'       => 'Kolom kabupaten tidak boleh kosong, silahkan memilih.',
                    'student_subdistric.required'    => 'Kolom kecamatan tidak boleh kosong, silahkan memilih.',
                    'student_village.required'       => 'Kolom kelurahan/desa tidak boleh kosong, silahkan memilih.',
                    'student_distance.required'      => 'Kolom jarak tempat tinggal tidak boleh kosong, silahkan memilih.',
                    'student_transport.required'     => 'Kolom tranportasi yang dipakai tidak boleh kosong, silahkan memilih.',
                    'student_travel.required'        => 'Kolom waktu tempuh tidak boleh kosong, silahkan memilih.',
                    'student_program.required'       => 'Kolom program pilihan tidak boleh kosong, silahkan memilih.',
                    'student_no_kk.required'         => 'Kolom nomor kartu keluarga tidak boleh kosong.',
                    'student_no_kk.min'         => 'Nomor kartu keluarga salah, silahkan periksa kembali.',
                    'student_no_kk.max'         => 'Nomor kartu keluarga salah, silahkan periksa kembali.',
                    'student_head_family.required'   => 'Kolom kepala keluarga tidak boleh kosong.',
                    'student_father_name.required'   => 'Kolom nama ayah kandung tidak boleh kosong.',
                    'student_father_birthplace.required' => 'Kolom tempat lahir ayah tidak boleh kosong.',
                    'student_father_birthday.required' => 'Kolom tanggal lahir ayah tidak boleh kosong.',
                    'student_father_status.required' => 'Kolom status ayah tidak boleh kosong, silahkan memilih.',
                    'student_father_nik.required' => 'Kolom NIK ayah tidak boleh kosong.',
                    'student_father_nik.min' => 'NIK ayah salah, silahkan periksa kembali.',
                    'student_father_nik.max' => 'NIK ayah salah, silahkan periksa kembali.',
                    'student_father_study' => 'Kolom pendidikan ayah tidak boleh kosong, silahkan memilih.',
                    'student_father_job' => 'Kolom pekerjaan ayah tidak boleh kosong, silahkan memilih.',
                    'student_father_earning' => 'Kolom pendapatan ayah tidak boleh kosong, silahkan memilih.',
                    'student_father_phone' => 'Kolom nomor HP ayah tidak boleh kosong',
                    'student_mother_name.required'   => 'Kolom nama ibu kandung tidak boleh kosong.',
                    'student_mother_birthplace.required' => 'Kolom tempat lahir ibu tidak boleh kosong.',
                    'student_mother_birthday.required' => 'Kolom tanggal lahir ibu tidak boleh kosong.',
                    'student_mother_status.required' => 'Kolom status ibu tidak boleh kosong, silahkan memilih.',
                    'student_mother_nik.required' => 'Kolom NIK ibu tidak boleh kosong.',
                    'student_mother_nik.min' => 'NIK ibu salah, silahkan periksa kembali.',
                    'student_mother_nik.max' => 'NIK ibu salah, silahkan periksa kembali.',
                    'student_mother_study' => 'Kolom pendidikan ibu tidak boleh kosong, silahkan memilih.',
                    'student_mother_job' => 'Kolom pekerjaan ibu tidak boleh kosong, silahkan memilih.',
                    'student_mother_earning' => 'Kolom pendapatan ibu tidak boleh kosong, silahkan memilih.',
                    'student_mother_phone' => 'Kolom nomor HP ibu tidak boleh kosong',
                    'student_guard_name.required'   => 'Kolom nama wali kandung tidak boleh kosong.',
                    'student_guard_birthplace.required' => 'Kolom tempat lahir wali tidak boleh kosong.',
                    'student_guard_birthday.required' => 'Kolom tanggal lahir wali tidak boleh kosong.',
                    'student_guard_nik.required' => 'Kolom NIK wali tidak boleh kosong.',
                    'student_guard_nik.min' => 'NIK wali salah, silahkan periksa kembali.',
                    'student_guard_nik.max' => 'NIK wali salah, silahkan periksa kembali.',
                    'student_guard_study.required' => 'Kolom pendidikan wali tidak boleh kosong, silahkan memilih.',
                    'student_guard_job.required' => 'Kolom pekerjaan wali tidak boleh kosong, silahkan memilih.',
                    'student_guard_earning.required' => 'Kolom pendapatan wali tidak boleh kosong, silahkan memilih.',
                    'student_guard_phone.required' => 'Kolom nomor HP wali tidak boleh kosong.',
                    'student_home_owner.required' => 'Kolom status kepemilikan rumah tidak boleh kosong, silahkan memilih.',
                    'student_home_address.required' => 'Kolom alamat rumah orangtua tidak boleh kosong.',
                    'student_home_postal.required' => 'Kolom kodepos rumah orangtua tidak boleh kosong.',
                    'student_home_province.required' => 'Kolom propinsi rumah orangtua tidak boleh kosong, silahkan memilih.',
                    'student_home_distric.required' => 'Kolom kabupaten rumah orangtua tidak boleh kosong, silahkan memilih.',
                    'student_home_subdistric.required' => 'Kolom kecamatan rumah orangtua tidak boleh kosong, silahkan memilih.',
                    'student_home_village.required' => 'Kolom kelurahan/desa rumah orangtua tidak boleh kosong, silahkan memilih.',
                    'student_school_from.required' => 'Kolom jenis sekolah asal tidak boleh kosong.',
                    'student_school_name.required' => 'Kolom nama sekolah asal tidak boleh kosong',
                    'student_school_address.required' => 'Kolom alamat sekolah asal tidak boleh kosong.',
                ];
                try {
                    $validator = Validator::make($request->all(), $form, $message);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else{
                        $student = Student::find($request->student_id);
                        $student->student_name          = $request->student_name;
                        $student->student_nisn          = $request->student_nisn;
                        $student->student_nik           = $request->student_nik;
                        $student->student_birthplace    = $request->student_birthplace;
                        $student->student_birthday      = Carbon::createFromFormat('d/m/Y', $request->student_birthday)->format('Y-m-d');
                        $student->student_gender        = $request->student_gender;
                        $student->student_religion      = $request->student_religion;
                        $student->student_siblingplace  = $request->student_siblingplace;
                        $student->student_sibling       = $request->student_sibling;
                        $student->student_civic         = $request->student_civic;
                        $student->student_hobby         = $request->student_hobby;
                        $student->student_purpose       = $request->student_purpose;
                        $student->student_email       = $request->student_email;
                        $student->student_phone       = $request->student_phone;
                        $student->student_residence     = $request->student_residence;
                        $student->student_address       = $request->student_address;
                        $student->student_province      = $request->student_province;
                        $student->student_distric       = $request->student_distric;
                        $student->student_subdistric    = $request->student_subdistric;
                        $student->student_village       = $request->student_village;
                        $student->student_postal        = $request->student_postal;
                        $student->student_distance      = $request->student_distance;
                        $student->student_transport     = $request->student_transport;
                        $student->student_travel        = $request->student_travel;
                        $student->student_program       = $request->student_program;
                        $student->student_boarding       = $request->student_boarding;
                        $student->student_im_hepatitis  = $request->student_im_hepatitis;
                        $student->student_im_polio      = $request->student_im_polio;
                        $student->student_im_bcg        = $request->student_im_bcg;
                        $student->student_im_campak     = $request->student_im_campak;
                        $student->student_im_dpt        = $request->student_im_dpt;
                        $student->student_im_covid        = $request->student_im_covid;
                        $student->student_no_kk         = $request->student_no_kk;
                        $student->student_head_family   = $request->student_head_family;
                        $student->student_father_name   = $request->student_father_name;
                        $student->student_mother_name   = $request->student_mother_name;
                        $student->student_father_birthplace   = $request->student_father_birthplace;
                        $student->student_mother_birthplace   = $request->student_mother_birthplace;
                        $student->student_father_birthday = Carbon::createFromFormat('d/m/Y', $request->student_father_birthday)->format('Y-m-d');
                        $student->student_mother_birthday = Carbon::createFromFormat('d/m/Y', $request->student_mother_birthday)->format('Y-m-d');
                        $student->student_father_status = $request->student_father_status;
                        $student->student_mother_status = $request->student_mother_status;
                        $student->student_father_nik = $request->student_father_nik;
                        $student->student_mother_nik = $request->student_mother_nik;
                        $student->student_father_study = $request->student_father_study;
                        $student->student_mother_study = $request->student_mother_study;
                        $student->student_father_job = $request->student_father_job;
                        $student->student_mother_job = $request->student_mother_job;
                        $student->student_father_earning = $request->student_father_earning;
                        $student->student_mother_earning = $request->student_mother_earning;
                        $student->student_father_phone = $request->student_father_phone;
                        $student->student_mother_phone = $request->student_mother_phone;
                        $student->student_guard_name   = $request->student_guard_name;
                        $student->student_guard_birthplace   = $request->student_guard_birthplace;
                        $student->student_guard_birthday = Carbon::createFromFormat('d/m/Y', $request->student_guard_birthday)->format('Y-m-d');
                        $student->student_guard_nik = $request->student_guard_nik;
                        $student->student_guard_study = $request->student_guard_study;
                        $student->student_guard_job = $request->student_guard_job;
                        $student->student_guard_earning = $request->student_guard_earning;
                        $student->student_guard_phone = $request->student_guard_phone;
                        $student->student_home_owner = $request->student_home_owner;
                        $student->student_home_address = $request->student_home_address;
                        $student->student_home_postal = $request->student_home_postal;
                        $student->student_home_province = $request->student_home_province;
                        $student->student_home_distric = $request->student_home_distric;
                        $student->student_home_subdistric = $request->student_home_subdistric;
                        $student->student_home_village = $request->student_home_village;
                        $student->student_kip_no = $request->student_kip_no;
                        $student->student_kip_file = $request->student_kip_file == null ? 0 : $request->student_kip_file;
                        $student->student_pkh_no = $request->student_pkh_no;
                        $student->student_pkh_file = $request->student_pkh_file == null ? 0 : $request->student_pkh_file;
                        $student->student_kks_no = $request->student_kks_no;
                        $student->student_kks_file = $request->student_kks_file == null ? 0 : $request->student_kks_file;
                        $student->student_school_from = $request->student_school_from;
                        $student->student_school_name = $request->student_school_name;
                        $student->student_school_npsn = $request->student_school_npsn;
                        $student->student_school_address = $request->student_school_address;
                        $student->student_swaphoto = $request->student_swaphoto;
                        $student->student_ktp_photo = $request->student_ktp_photo;
                        $student->student_akta_photo = $request->student_akta_photo;
                        $student->student_kk_photo = $request->student_kk_photo;
                        $student->student_ijazah_photo = $request->student_ijazah_photo;
                        $student->student_skhun_photo = $request->student_skhun_photo;
                        if ($student->save()){
                            $msg = ['title' => 'Berhasil !', 'class' => 'success', 'text' => 'Data siswa berhasil di simpan.'];
                        }
                    }
                }
                catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $student = Student::find($request->student_id);
                    if ($student->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data siswa berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('admission.backend.student', $this->data);
        }
    }

    public function studentadd(Request $request)
    {
        $this->data['compelete'] = false;
        $this->data['type'] = 'store';
        return view('admission.backend.student_add', $this->data);
    }

    public function studentedit($id)
    {
        $student = Student::find($id);
        $this->data['type'] = 'edit';
        $this->data['student'] = $student;
        $this->data['compelete'] = $student->checkdata();
        return view('admission.backend.student_edit', $this->data);
    }

    public function payment(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all') {
                if ($request->payment_status == 0){
                    $payments = Payment::orderBy('payment_transaction_date', 'ASC')->get();
                }
                elseif ($request->payment_status != 0){
                    $payments = Payment::where('payment_status', $request->payment_status)->get();
                }
                foreach ($payments as $payment) {
                    $data[] = [
                        "#INV". sprintf("%04d", $payment->payment_id),
                        $payment->student->student_name,
                        $payment->student->student_boarding == 1 ? $payment->student->program->program_name .'/'. 'Boarding' : $payment->student->program->program_name .'/'. 'Non Boarding',
                        'Rp. '. number_format($payment->payment_amount),
                        Carbon::create($payment->payment_transaction_date)->translatedFormat('d/m/Y H:i:s'),
                        $payment->status(),
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-view" data-num="'. $payment->payment_id .'"><i class="icon-user"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'. $payment->payment_id .'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="' . $payment->payment_id . '"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'payment'){
                $payment = Payment::find($request->payment_id);
                $payment->payment_invoice = number_format($payment->invoice->invoice_amount);
                $payment->payment_amount = number_format($payment->payment_amount);
                $payment->payment_transaction_date = Carbon::create($payment->payment_transaction_date)->format('d/m/Y H:i:s');
                $payment->payment_transaction_file = asset('storage/admission/fronted/images/transaction/'. $payment->payment_transaction_file);
                $msg = $payment;
            }
            elseif ($request->_type == 'update' && $request->_data == 'payment'){
                try {
                    $payment = Payment::find($request->payment_id);
                    if ($payment->payment_status == 1){
                        throw new \Exception('Pembayaran belum dilakukan, anda tidak bisa memverifikasi transaksi ini.');
                    }
                    elseif (in_array($payment->payment_status, [3,4])){
                        throw new \Exception('Verifikasi telah dilakukan, anda tidak bisa melakukan verifikasi lagi.');
                    }
                    else {
                        $payment->payment_status = $request->payment_status;
                        if ($payment->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Verifikasi pembayaran berhasil dilakukan.'];
                        }
                    }
                }
                catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $payment = Payment::find($request->payment_id);
                    if (in_array($payment->payment_status, [3,4])){
                        throw new \Exception('Pembayaran telah di verifikasi, anda tidak bisa menghapus transaksi ini');
                    }
                    else {
                        if ($payment->delete()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Pembayaran berhasil dihapus.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('admission.backend.payment', $this->data);
        }
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
