<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Models\Admission\Form;
use App\Models\Admission\Setting;
use App\Models\Admission\Student;
use App\Models\Master\School;
use Carbon\Carbon;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FrontedController extends Controller
{
    public $data;

    public function __construct()
    {
        $this->data['school'] = School::first();
        $this->data['setting'] = new Setting();
    }

    public function home()
    {
        $this->data['title'] = 'Dashboard';
        return view('admission.fronted.home', $this->data);
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'store'){
                $msg = $this->store($request);
            }
            elseif ($request->_type == 'update'){
                $msg = $this->update($request);
            }
            elseif ($request->_type == 'login'){
                $msg = $this->login($request);
            }
            elseif ($request->_type == 'logout'){
                $msg = $this->logout();
            }
            elseif ($request->_type == 'print')
            {
                return $this->print($request);
            }
            return response()->json($msg);
        }
        else {
            if (Session::has('auth')){
                $student = Session::get('auth');
                $student = Student::find($student->student_id);
                $checker = $student->toArray();
                $key = array_keys($checker);
                $compelete = [];
                for ($i=0;$i<count($checker);$i++){
                    if ($checker[$key[$i]] == null){
                        $compelete[] = [$key[$i] => $checker[$key[$i]]];
                    }
                }

                $this->data['student'] = $student;
                $this->data['compelete'] = count($compelete) >= 8 ? false : true;
                return view('admission.fronted.register_detail', $this->data);
            }
            else {
                return view('admission.fronted.register', $this->data);
            }
        }
    }

    public function authenticate($uuid)
    {
        $form = Form::where('form_uuid', $uuid)->first();
        return view('admission.fronted.authenticate', compact('form'));
    }

    public function term()
    {
        return view('admission.fronted.term');
    }

    public function store(Request $request)
    {
        try {
            if ($request->check_agreement == null){
                throw new \Exception('Silahkan centang persetujuan terlebih dahulu.');
            }
            else {
                if ($request->student_nisn != null && Student::where('student_nisn', $request->student_nisn)->count() >= 1){
                    throw new \Exception('NISN telah terdaftar, silahkan melengkapi pendaftaran.');
                }
                elseif (Student::where('student_nik', $request->student_nik)->count() >= 1){
                    throw new \Exception('NIK telah terdaftar, silahkan melengkapi pendaftaran.');
                }
                else {
                    $validator = Validator::make($request->all(), [
                        'student_name' => 'required|max:200',
                        'student_nisn' => 'nullable|min:10|max:10',
                        'student_nik' => 'required|min:16|max:16',
                        'student_birthplace' => 'required',
                        'student_birthday' => 'required|date_format:d/m/Y',
                        'student_gender' => 'required',
                        'student_religion' => 'required',
                        'student_siblingplace' => 'required',
                        'student_sibling' => 'required',
                        'student_civic' => 'required',
                        'student_hobby' => 'required',
                        'student_purpose' => 'required',
                        'student_email' => 'nullable|email',
                        'student_phone' => 'required',
                        'student_residence' => 'required',
                        'student_address' => 'required|string|max:200',
                        'student_province' => 'required',
                        'student_distric' => 'required',
                        'student_subdistric' => 'required',
                        'student_village' => 'required',
                        'student_distance' => 'required',
                        'student_transport' => 'required',
                        'student_travel' => 'required',
                        'student_program' => 'required',
                    ],
                        [
                            'student_name.required' => 'Kolom nama lengkap tidak boleh kosong.',
                            'student_name.max' => 'Panjang karakter maksimal 200 huruf.',
                            'student_nisn.min' => 'NISN salah, pastikan berjumlah 10 digit.',
                            'student_nisn.max' => 'NISN salah, pastikan berjumlah 10 digit.',
                            'student_nik.required' => 'NIK salah, pastikan berjumlah 16 digit.',
                            'student_nik.min' => 'NIK salah, pastikan berjumlah 16 digit.',
                            'student_nik.max' => 'NIK salah, pastikan berjumlah 16 digit.',
                            'student_birthplace.required' => 'Kolom tempat lahir tidak boleh kosong.',
                            'student_birthday.required' => 'Kolom tanggal lahir tidak boleh kosong.',
                            'student_gender.required' => 'Kolom jenis kelamin tidak boleh kosong, silahkan pilih.',
                            'student_religion.required' => 'Kolom agama tidak boleh kosong, silahkan pilih.',
                            'student_siblingplace.required' => 'Kolom anak-ke tidak boleh kosong.',
                            'student_sibling.required' => 'Kolom jumlah saudara tidak boleh kosong.',
                            'student_civic.required' => 'Kolom kewarganegaraan tidak boleh kosong, silahkan pilih.',
                            'student_hobby.required' => 'Kolom Hobi tidak boleh kosong, silahkan pilih.',
                            'student_purpose.required' => 'Kolom cita-cita tidak boleh kosong, silahkan pilih.',
                            'student_phone.required' => 'Kolom nomor HP tidak boleh kosong.',
                            'student_residence.required' => 'Kolom status tempat tinggal tidak boleh kosong, silahkan pilih.',
                            'student_address.required' => 'Kolom alamat tidak boleh kosong.',
                            'student_province.required' => 'Kolom propinsi tidak boleh kosong, silahkan pilih.',
                            'student_distric.required' => 'Kolom kabupaten tidak boleh kosong, silahkan pilih.',
                            'student_subdistric.required' => 'Kolom kecamatan tidak boleh kosong, silahkan pilih.',
                            'student_village.required' => 'Kolom kelurahan/desa tidak boleh kosong, silahkan pilih.',
                            'student_distance.required' => 'Kolom jarak tempat tinggal tidak boleh kosong, silahkan pilih.',
                            'student_transport.required' => 'Kolom transportasi tidak boleh kosong, silahkan pilih.',
                            'student_travel.required' => 'Kolom waktu tempuh tidak boleh kosong, silahkan pilih.',
                            'student_program.required' => 'Kolom program pilihan tidak boleh kosong, silahkan pilih.',
                        ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $student = new Student();
                        $student->student_name = $request->student_name;
                        $student->student_nisn = $request->student_nisn;
                        $student->student_nik = $request->student_nik;
                        $student->student_birthplace = $request->student_birthplace;
                        $student->student_birthday = Carbon::createFromFormat('d/m/Y', $request->student_birthday)->format('Y-m-d');
                        $student->student_gender = $request->student_gender;
                        $student->student_religion = $request->student_religion;
                        $student->student_siblingplace = $request->student_siblingplace;
                        $student->student_sibling = $request->student_sibling;
                        $student->student_civic = $request->student_civic;
                        $student->student_hobby = $request->student_hobby;
                        $student->student_purpose = $request->student_purpose;
                        $student->student_email = $request->student_email;
                        $student->student_phone = $request->student_phone;
                        $student->student_residence = $request->student_residence;
                        $student->student_address = $request->student_address;
                        $student->student_province = $request->student_province;
                        $student->student_distric = $request->student_distric;
                        $student->student_subdistric = $request->student_subdistric;
                        $student->student_village = $request->student_village;
                        $student->student_postal = $request->student_postal;
                        $student->student_distance = $request->student_distance;
                        $student->student_transport = $request->student_transport;
                        $student->student_travel = $request->student_travel;
                        $student->student_program = $request->student_program;
                        $student->student_boarding = $request->student_boarding;
                        $student->student_im_hepatitis = $request->student_im_hepatitis;
                        $student->student_im_polio = $request->student_im_polio;
                        $student->student_im_bcg = $request->student_im_bcg;
                        $student->student_im_campak = $request->student_im_campak;
                        $student->student_im_dpt = $request->student_im_dpt;
                        $student->student_im_covid = $request->student_im_covid;
                        if ($student->save()) {
                            $form = new Form();
                            $form->form_uuid    = Str::uuid();
                            $form->form_letter  = Form::latest('form_letter')->first() == null ? 1 : Form::latest('form_letter')->first()->form_letter + 1;
                            $form->form_student = $student->student_id;
                            $form->form_date    = Carbon::now()->format('Y-m-d');
                            $form->form_count   = 0;
                            $form->save();
                            $path = storage_path('app/public/admission/fronted/images/student/' . $student->student_nik . '_qrcode.png');
                            QrCode::size(110)
                                ->format('png')->generate(route('admission.authenticate', $form->form_uuid), $path);
                            $msg = ['title' => 'Berhasil !', 'class' => 'success', 'text' => 'Pendaftaran berhasil, silahkan masuk menggunakan NIS/NIK & Tanggal Lahir untuk melengkapi pendfataran.'];
                        }
                    }
                }
            }
        }
        catch (\Exception $e){
            $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
        }
        return $msg;
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_name'          => 'required|string|max:200',
            'student_nisn'          => 'required|string|min:10|max:10',
            'student_nik'           => 'required|string|min:16|max:16',
            'student_birthplace'    => 'required|string',
            'student_birthday'      => 'required|date_format:d/m/Y',
            'student_gender'        => 'required',
            'student_religion'      => 'required',
            'student_siblingplace'  => 'required',
            'student_sibling'       => 'required',
            'student_civic'         => 'required',
            'student_hobby'         => 'required',
            'student_purpose'       => 'required',
            'student_residence'     => 'required',
            'student_address'       => 'required|string|max:200',
            'student_province'      => 'required',
            'student_distric'       => 'required',
            'student_subdistric'    => 'required',
            'student_village'       => 'required',
            'student_distance'      => 'required',
            'student_transport'     => 'required',
            'student_travel'        => 'required',
            'student_program'       => 'required',
            'student_no_kk'         => 'required|min:16|max:16',
            'student_head_family'   => 'required|string',
            'student_father_name'   => 'required',
            'student_mother_name'   => 'required',
            'student_father_birthday' => 'required',
            'student_mother_birthday' => 'required',
            'student_father_status' => 'required',
            'student_mother_status' => 'required',
            'student_father_nik' => 'required|min:16|max:16',
            'student_mother_nik' => 'required|min:16|max:16',
            'student_father_study' => 'required',
            'student_mother_study' => 'required',
            'student_father_job' => 'required',
            'student_mother_job' => 'required',
            'student_father_earning' => 'required',
            'student_mother_earning' => 'required',
            'student_father_phone' => 'required',
            'student_mother_phone' => 'required',
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
            'student_swaphoto' => 'mimes:jpg,jpeg|max:600',
            'student_akta_photo' => 'mimes:jpg,jpeg|max:600',
            'student_kk_photo' => 'mimes:jpg,jpeg|max:600',
            'student_ijazah_photo' => 'mimes:jpg,jpeg|max:600',
            'student_skhun_photo' => 'mimes:jpg,jpeg|max:600',
            'student_sholarship_photo' => 'mimes:jpg,jpeg|max:600',
        ], [
            'required' => 'kolom :attribute tidak boleh kosong',
            'string' => 'kolom :attribute data harus bertipe huruf/angka',
            'max' => 'nomor :attribute tidak sesuai',
            'min' => 'nomor :attribute data tidak sesuai',
            'mimes' => ':attribute harus berekstensi .jpg, .jpeg',
            'size' => ':attribute ukuran maksimal 512 Kb',
        ]);
        if ($validator->fails()) {
            $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $validator->errors()->first()];
        }
        else {
            try {
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
                $student->student_im_hepatitis  = $request->student_im_hepatitis;
                $student->student_im_polio      = $request->student_im_polio;
                $student->student_im_bcg        = $request->student_im_bcg;
                $student->student_im_campak     = $request->student_im_campak;
                $student->student_im_dpt        = $request->student_im_dpt;
                $student->student_no_kk         = $request->student_no_kk;
                $student->student_head_family   = $request->student_head_family;
                $student->student_father_name   = $request->student_father_name;
                $student->student_mother_name   = $request->student_mother_name;
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
                $student->student_home_owner = $request->student_home_owner;
                $student->student_home_address = $request->student_home_address;
                $student->student_home_postal = $request->student_home_postal;
                $student->student_home_province = $request->student_home_province;
                $student->student_home_distric = $request->student_home_distric;
                $student->student_home_subdistric = $request->student_home_subdistric;
                $student->student_home_village = $request->student_home_village;
                $student->student_school_from = $request->student_school_from;
                $student->student_school_name = $request->student_school_name;
                $student->student_school_npsn = $request->student_school_npsn;
                $student->student_school_address = $request->student_school_address;
                $path = storage_path('app/public/admission/fronted/images/student/');
                if ($request->hasFile('student_swaphoto')){
                    $request->file('student_swaphoto')->move($path , $student->student_nisn .'_swaphoto.jpg');
                    $student->student_swaphoto = 1;
                }
                if ($request->hasFile('student_akta_photo')){
                    $request->file('student_akta_photo')->move($path , $student->student_nisn .'_akta.jpg');
                    $student->student_akta_photo = 1;
                }
                if ($request->hasFile('student_kk_photo')){
                    $request->file('student_kk_photo')->move($path , $student->student_nisn .'_kk.jpg');
                    $student->student_kk_photo = 1;
                }
                if ($request->hasFile('student_ijazah_photo')){
                    $request->file('student_ijazah_photo')->move($path , $student->student_nisn .'_ijazah.jpg');
                    $student->student_ijazah_photo = 1;
                }
                if ($request->hasFile('student_skhun_photo')){
                    $request->file('student_skhun_photo')->move($path , $student->student_nisn .'_skhun.jpg');
                    $student->student_skhun_photo = 1;
                }
                if ($request->hasFile('student_sholarship_photo')){
                    $request->file('student_sholarship_photo')->move($path , $student->student_nisn .'_scholarship.jpg');
                    $student->student_sholarship_photo = 1;
                }

                if ($student->save()){
                    $msg = ['title' => 'Berhasil !', 'class' => 'success', 'text' => 'Pendaftaran berhasil, silahkan masuk menggunakan NIS & Tanggal Lahir untuk melengkapi pendfataran.'];
                }
            }
            catch (\Exception $e){
                $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
            }
        }
        return $msg;
    }

    public function login(Request $request)
    {
        try {
            if(Student::where('student_nisn', $request->student_nisn)->first() != null || Student::where('student_nik', $request->student_nisn)->first() != null){
                $student = $request->student_nisn == null ? Student::where('student_nisn', $request->student_nisn)->first() : Student::where('student_nik', $request->student_nisn)->first();
                if ($student->birthday() == $request->student_birthday){
                    Session::put('auth', $student);
                    $msg = ['title' => 'Berhasil !', 'class' => 'success', 'text' => 'Berhasil masuk, anda akan di alihkan ke halaman lengkapi formulir dalam 2 detik.'];
                }
                else {
                    throw new \Exception('NISN & Tanggal lahir tidak tepat, silahkan periksa kembali.');
                }
            }
            else {
                throw new \Exception('Gagal masuk, NISN/NIK tidak di temukan.');
            }
        }
        catch (\Exception $e){
            $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
        }
        return $msg;
    }

    public function logout()
    {
        Session::forget('auth');
        return  ['title' => 'Berhasil !', 'class' => 'success', 'text' => 'Berhasil keluar, anda akan di arahkan ke halaman beranda dalam 2 detik.'];
    }

    public function print(Request $request)
    {
        $cert = 'file://'. realpath(storage_path('app/cert/selfcert.pem'));
        $key = 'file://'. realpath(storage_path('app/cert/enc_key.pem'));
        $info = array(
            'Name' => 'Kepala MTs. Darul Hikmah Menganti',
            'Reason' => 'Formulir PPDB TP. 2021/2022',
            'Location' => 'MTs. Darul Hikmah Menganti',
            'ContactInfo' => 'mts@darul-hikmah.sch.id',
        );

        $month = ['01' => 'I', '02' => 'II', '03' => 'III', '04' => 'IV', '05' => "V", '06' => 'VI', '07' => 'VII', '08' => 'VIII', '09' => 'IX', '10' => 'X', '11' => 'XI', '12' =>'XII'];
        $now = Carbon::now();
        $student = Student::find($request->_data);
        $form = Form::where('form_student', $request->_data)->first();
        if ($form->form_letter == null){
            $form->form_letter = rand(1000, 9999) . '/PPDB.MTs.DH/PP.006/'.$month[$now->format('m')].'/'.$now->format('Y');
        }
        $form->save();
        $data = [
            'student' => $student,
            'form' => $form

        ];
        $view = View::make('admission.fronted.register_print', $data)->render();
        TCPDF::setSignature($cert, $key, 'myu2nnmd', '', 2, $info);
        TCPDF::SetFont('times', '', 12);
        TCPDF::SetMargins(1, 1, 1);
        TCPDF::SetAutoPageBreak(true, 0);
        TCPDF::AddPage();
        TCPDF::writeHTML($view, true, 0, true, 0, '');
        TCPDF::setSignatureAppearance(1, 8.3, 5.1, 4.1);
        TCPDF::Output('formulir-'. $student->student_nisn .'.pdf');
        TCPDF::reset();
    }

    public function result(Request $request)
    {
        if ($request->isMethod('post')) {
            if($request->_type == 'data' && $request->_data == 'all'){
                $student = 0;
                for ($i=1;$i<13;$i++){
                    $all[] = $student = Student::whereMonth('created_at', $i)->count() > 0 ? Student::whereMonth('created_at', $i)->count() + $student: 0;
                }
                $data[] = array_merge(['Jumlah Pendaftar'], $all);
            }
            elseif ($request->_type == 'data' && $request->_data == 'gender'){
                $student = 0;
                for ($i=1;$i<3;$i++) {
                    for ($j = 1; $j < 13; $j++) {
                        $count[] = $student = Student::whereMonth('created_at', $j)
                            ->where('student_gender', $i)->count() > 0 ? Student::whereMonth('created_at', $j)
                                ->where('student_gender', $i)->count() + $student : 0;
                    }
                    $gender = $i == 1 ? array_merge(['Jumlah Laki-laki'], $count) : array_merge(['Jumlah Perempuan'], $count) ;
                    $count = [];
                    $student = 0;
                    $data[] = $gender;
                }
            }
            elseif ($request->_type == 'data' && $request->_data == 'program'){
                $student = 0;
                for ($i=1;$i<5;$i++) {
                    for ($j = 1; $j < 13; $j++) {
                        $count[] = $student = Student::whereMonth('created_at', $j)
                            ->where('student_program', $i)->count() > 0 ? Student::whereMonth('created_at', $j)
                                ->where('student_program', $i)->count() + $student : 0;
                    }
                    if ($i == 1){
                        $program = array_merge(['Tahfidz'], $count);
                    }
                    elseif ($i == 2){
                        $program = array_merge(['Sains & Bahasa'], $count);
                    }
                    elseif ($i == 3){
                        $program = array_merge(['Kitab Kuning'], $count);
                    }
                    elseif ($i == 4){
                        $program = array_merge(['Kelas Reguler'], $count);
                    }
                    $count = [];
                    $student = 0;
                    $data[] = $program;
                }
            }
            return response()->json($data);
        }
        else {
            return view('admission.fronted.result', $this->data);
        }
    }

    public function registrant(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all') {
                $no = 1;
                foreach (Student::orderBy('created_at', 'ASC')->get() as $student) {
                    $data[] = [
                        $no++,
                        $student->student_name,
                        $student->student_nik,
                        $student->student_nisn,
                        $student->student_address,
                        $student->student_father_name,
                        $student->student_mother_name,
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            return response()->json($msg);
        }
        else {
            return view('admission.fronted.registrant', $this->data);
        }
    }

    public function test()
    {
        $student = 0;
        for ($i=1;$i<3;$i++) {
            for ($j = 1; $j < 13; $j++) {
                $count[] = $student = Student::whereMonth('created_at', $j)
                    ->where('student_gender', $i)->count() > 0 ? Student::whereMonth('created_at', $j)
                    ->where('student_gender', $i)->count() + $student : 0;
            }
            $gender = $i == 1 ? array_merge(['Jumlah Laki-laki'], $count) : array_merge(['Jumlah Perempuan'], $count) ;
            $count = [];
            $student = 0;
            $data[] = $gender;
        }

        return response()->json($data);
    }
}
