@extends('admission.fronted.layouts.master', ['title' => 'Pendaftaran'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/styling/uniform.min.js')}}"></script>
    <script src="{{asset("assets/js/plugins/selects/select2.min.js")}}"></script>
    <script src="{{asset('assets/js/plugins/pickers/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset("assets/apps/admission/fronted/js/register_detail.js")}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Pendaftaran</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">A. INFORMASI PRIBADI</h6>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body collapse">
                    <div class="col-md-12 offset-md-0">
                        <input type="hidden" id="student_id" value="{{$student->student_id}}">
                        <div class="form-group">
                            <label>Nama Lengkap :</label>
                            <input type="text" id="student_name" class="form-control" value="{{$student->student_name}}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Induk Siswa Nasional :</label>
                                    <input type="text" id="student_nisn" value="{{$student->student_nisn}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Induk Kependudukan :</label>
                                    <input type="text" id="student_nik" value="{{$student->student_nik}}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir:</label>
                                    <input type="text" id="student_birthplace" class="form-control" value="{{$student->student_birthplace}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="text" id="student_birthday" class="form-control daterange" value="{{$student->birthday()}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Jenis Kelamin : </label>
                                <div class="form-group">
                                    <select id="student_gender" data-placeholder="Pilih Jenis Kelamin" class="form-control select2">
                                        <option value="{{$student->student_gender}}">{{\App\Models\Master\Gender::name($student->student_gender)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Agama :</label>
                                    <select id="student_religion" data-placeholder="Pilih Agama" class="form-control select2">
                                        <option value="{{$student->student_religion}}">{{\App\Models\Master\Religion::name($student->student_religion)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Anak Ke :</label>
                                    <input type="text" id="student_siblingplace" class="form-control" value="{{$student->student_siblingplace}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah Saudara :</label>
                                    <input type="text" id="student_sibling" class="form-control" value="{{$student->student_sibling}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Kewarganegaraan : </label>
                                <div class="form-group">
                                    <select id="student_civic" data-placeholder="Pilih Kewarganegaraan" class="form-control select2">
                                        <option value="{{$student->student_civic}}">{{\App\Models\Master\Civic::name($student->student_civic)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Hobi :</label>
                                    <select id="student_hobby" data-placeholder="Pilih Hobi" class="form-control select2">
                                        <option value="{{$student->student_hobby}}">{{\App\Models\Student\Hobby::name($student->student_hobby)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Cita-cita :</label>
                                    <select id="student_purpose" data-placeholder="Pilih Cita-cita" class="form-control select2">
                                        <option value="{{$student->student_purpose}}">{{\App\Models\Student\Purpose::name($student->student_purpose)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email : </label>
                                <div class="form-group">
                                    <input type="text" id="student_email" class="form-control" value="{{$student->student_email}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor HP :</label>
                                    <input type="text" id="student_phone" class="form-control" value="{{$student->student_phone}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3 mb-md-2">
                                    <label>Imunisasi :</label>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input-styled" id="student_im_hepatitis"
                                                           {{$student->student_im_hepatitis == 1 ? 'checked' : null}}>Hepatitis</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input-styled" id="student_im_polio"
                                                        {{$student->student_im_polio == 1 ? 'checked' : null}}>Polio
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input-styled" id="student_im_bcg"
                                                        {{$student->student_im_bcg == 1 ? 'checked' : null}}>BCG
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input-styled" id="student_im_campak"
                                                        {{$student->student_im_campak == 1 ? 'checked' : null}}>Campak
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input-styled" id="student_im_dpt"
                                                        {{$student->student_im_dpt == 1 ? 'checked' : null}}>DPT
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input-styled" id="student_im_covid"
                                                        {{$student->student_im_covid == 1 ? 'checked' : null}}>Covid-19
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">B. INFORMASI TEMPAT TINGGAL</h6>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse" href="#residencecard" role="button"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body collapse" id="residencecard">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Jenis Tempat Tinggal Siswa :</label>
                                    <select id="student_residence" data-placeholder="Pilih Tempat Tinggal" class="form-control select2">
                                        <option value="{{$student->student_residence}}">{{\App\Models\Student\Residence::name($student->student_residence)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Alamat :</label>
                                    <input type="text" id="student_address" class="form-control" value="{{$student->student_address}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Propinsi :</label>
                                    <select id="student_province" data-placeholder="Pilih Propinsi" class="form-control select2">
                                        <option value="{{$student->student_province}}">{{\App\Models\Master\Territory::province($student->student_province)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kabupaten/Kota :</label>
                                    <select id="student_distric" data-placeholder="Pilih Kebupaten/Kota" class="form-control select2">
                                        <option value="{{$student->student_distric}}">{{\App\Models\Master\Territory::distric($student->student_distric)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kecamantan :</label>
                                    <select id="student_subdistric" data-placeholder="Pilih Kecamatan" class="form-control select2">
                                        <option value="{{$student->student_subdistric}}">{{\App\Models\Master\Territory::subdistric($student->student_subdistric)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keluranan/Desa :</label>
                                    <select id="student_village" data-placeholder="Pilih Kelurahan/Desa" class="form-control select2">
                                        <option value="{{$student->student_village}}">{{\App\Models\Master\Territory::village($student->student_subdistric, $student->student_village)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kodepos :</label>
                                    <input id="student_postal" class="form-control" value="{{$student->student_postal}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jarak Tempat Tinggal :</label>
                                    <select id="student_distance" data-placeholder="Pilih Jarak Tempat Tinggal" class="form-control select2">
                                        <option value="{{$student->student_distance}}">{{\App\Models\Master\Distance::name($student->student_distance)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Transportasi yang Dipakai :</label>
                                    <select id="student_transport" data-placeholder="Pilih Transportasi" class="form-control select2">
                                        <option value="{{$student->student_transport}}">{{\App\Models\Master\Transport::name($student->student_transport)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Waktu Tempuh (Menit) :</label>
                                    <select id="student_travel" data-placeholder="Pilih Waktu Tempuh" class="form-control select2">
                                        <option value="{{$student->student_travel}}">{{\App\Models\Master\Travel::name($student->student_travel)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">C. INFORMASI PROGRAM PILIHAN</h6>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse" href="#programcard" role="button"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body collapse" id="programcard">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Program Pilihan :</label>
                                    <select id="student_program" data-placeholder="Pilih Program" class="form-control select2">
                                        <option value="{{$student->student_program}}">{{\App\Models\Student\Program::name($student->student_program)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Boarding/Non Boarding :</label>
                                    <select id="student_boarding" data-placeholder="Pilih Boarding" class="form-control select2" {{in_array($student->student_program, [1,2,4]) ? 'disabled': null}}>
                                        <option value="1" {{$student->student_boarding == 1 ? 'selected' : null}}>Ya</option>
                                        <option value="2" {{$student->student_boarding == 2 ? 'selected' : null}}>Tidak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">D. INFORMASI ORANGTUA</h6>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse" href="#parentcard" role="button"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body collapse" id="parentcard">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Kartu Keluarga :</label>
                                    <input id="student_no_kk" class="form-control" value="{{$student->student_no_kk}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Kepala Keluarga :</label>
                                    <input id="student_head_family" class="form-control" value="{{$student->student_head_family}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Ayah :</label>
                                    <input id="student_father_name" class="form-control" value="{{$student->student_father_name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Ibu :</label>
                                    <input id="student_mother_name" class="form-control" value="{{$student->student_mother_name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Ayah :</label>
                                    <select id="student_father_status" data-placeholder="Pilih Status" class="form-control select2">
                                        <option value="{{$student->student_father_status}}" selected>{{\App\Models\Student\ParentStatus::name($student->student_father_status)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Ibu :</label>
                                    <select id="student_mother_status" data-placeholder="Pilih Status" class="form-control select2">
                                        <option value="{{$student->student_mother_status}}" selected>{{\App\Models\Student\ParentStatus::name($student->student_mother_status)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tempat Lahir Ayah:</label>
                                            <input id="student_father_birthplace" class="form-control" value="{{$student->student_father_birthplace}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Lahir Ayah :</label>
                                            <input type="text" id="student_father_birthday" class="form-control daterange" value="{{$student->fatherbirthday()}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tempat Lahir Ibu:</label>
                                            <input id="student_mother_birthplace" class="form-control" value="{{$student->student_mother_birthplace}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Lahir Ibu :</label>
                                            <input type="text" id="student_mother_birthday" class="form-control daterange" value="{{$student->motherbirthday()}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NIK Ayah :</label>
                                    <input id="student_father_nik" class="form-control" value="{{$student->student_father_nik}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NIK Ibu :</label>
                                    <input id="student_mother_nik" class="form-control" value="{{$student->student_mother_nik}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pendidikan Ayah :</label>
                                    <select id="student_father_study" data-placeholder="Pilih Pendidikan" class="form-control select2">
                                        <option value="{{$student->student_father_study}}" selected>{{\App\Models\Master\Study::name($student->student_father_study)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pendidikan Ibu :</label>
                                    <select id="student_mother_study" data-placeholder="Pilih Pendidikan" class="form-control select2">
                                        <option value="{{$student->student_mother_study}}" selected>{{\App\Models\Master\Study::name($student->student_mother_study)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pekerjaan Ayah :</label>
                                    <select id="student_father_job" data-placeholder="Pilih Pekerjaan" class="form-control select2">
                                        <option value="{{$student->student_father_job}}" selected>{{\App\Models\Master\Job::name($student->student_father_job)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pekerjaan Ibu :</label>
                                    <select id="student_mother_job" data-placeholder="Pilih Pekerjaan" class="form-control select2">
                                        <option value="{{$student->student_mother_job}}" selected>{{\App\Models\Master\Job::name($student->student_mother_job)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penghasilan Ayah :</label>
                                    <select id="student_father_earning" data-placeholder="Pilih Penghasilan" class="form-control select2">
                                        <option value="{{$student->student_father_earning}}" selected>{{\App\Models\Master\Earning::name($student->student_father_earning)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penghasilan Ibu :</label>
                                    <select id="student_mother_earning" data-placeholder="Pilih Penghasilan" class="form-control select2">
                                        <option value="{{$student->student_mother_earning}}" selected>{{\App\Models\Master\Earning::name($student->student_mother_earning)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor HP Ayah :</label>
                                    <input id="student_father_phone" class="form-control" value="{{$student->student_father_phone}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor HP Ibu :</label>
                                    <input id="student_mother_phone" class="form-control" value="{{$student->student_mother_phone}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Wali Siswa :</label>
                                    <select id="student_guard_status" data-placeholder="Pilih Wali Siswa" class="form-control select2">
                                        <option></option>
                                        <option value="1">Sama dengan ayah kandung</option>
                                        <option value="2">Sama dengan ibu kandung</option>
                                        <option value="3">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Wali :</label>
                                    <input id="student_guard_name" class="form-control" value="{{$student->student_guard_name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NIK Wali :</label>
                                    <input id="student_guard_nik" class="form-control" value="{{$student->student_guard_nik}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tempat Lahir Wali :</label>
                                    <input id="student_guard_birthplace" class="form-control" value="{{$student->student_guard_birthplace}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Lahir Wali :</label>
                                    <input type="text" id="student_guard_birthday" class="form-control daterange" value="{{$student->guardbirthday()}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pendidikan Wali :</label>
                                    <select id="student_guard_study" data-placeholder="Pilih Pendidikan" class="form-control select2">
                                        <option value="{{$student->student_guard_study}}" selected>{{\App\Models\Master\Study::name($student->student_guard_study)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pekerjaan Wali :</label>
                                    <select id="student_guard_job" data-placeholder="Pilih Pekerjaan" class="form-control select2">
                                        <option value="{{$student->student_guard_job}}" selected>{{\App\Models\Master\Job::name($student->student_guard_job)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Penghasilan Wali :</label>
                                    <select id="student_guard_earning" data-placeholder="Pilih Penghasilan" class="form-control select2">
                                        <option value="{{$student->student_guard_earning}}" selected>{{\App\Models\Master\Earning::name($student->student_guard_earning)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nomor HP Wali :</label>
                                    <input id="student_guard_phone" class="form-control" value="{{$student->student_guard_phone}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">E. INFORMASI TEMPAT TINGGAL ORANGTUA</h6>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse" href="#homecard" role="button"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body collapse" id="homecard">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Status Kepemilikan:</label>
                                    <select id="student_home_owner" data-placeholder="Pilih Status Kepemilikan" class="form-control select2">
                                        <option value="{{$student->student_home_owner}}" selected>{{\App\Models\Master\Home::name($student->student_home_owner)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Alamat :</label>
                                    <input type="text" id="student_home_address" class="form-control" value="{{$student->student_home_address}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kodepos :</label>
                                    <input id="student_home_postal" class="form-control" value="{{$student->student_home_postal}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Propinsi :</label>
                                    <select id="student_home_province" data-placeholder="Pilih Propinsi" class="form-control select2">
                                        <option value="{{$student->student_home_province}}">{{\App\Models\Master\Territory::province($student->student_home_province)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kabupaten/Kota :</label>
                                    <select id="student_home_distric" data-placeholder="Pilih Kebupaten/Kota" class="form-control select2">
                                        <option value="{{$student->student_home_distric}}">{{\App\Models\Master\Territory::distric($student->student_home_distric)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kecamantan :</label>
                                    <select id="student_home_subdistric" data-placeholder="Pilih Kecamatan" class="form-control select2">
                                        <option value="{{$student->student_home_subdistric}}">{{\App\Models\Master\Territory::subdistric($student->student_home_subdistric)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keluranan/Desa :</label>
                                    <select id="student_home_village" data-placeholder="Pilih Kelurahan/Desa" class="form-control select2">
                                        <option value="{{$student->student_home_village}}">{{\App\Models\Master\Territory::village($student->student_home_subdistric, $student->student_home_village)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">F. INFORMASI BANTUAN</h6>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse" href="#scholarshipcard" role="button"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body collapse" id="scholarshipcard">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor KIP :</label>
                                    <input type="text" id="student_kip_no" class="form-control" value="{{$student->student_kip_no}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Berkas KIP : </label>
                                    <input type="file" id="student_kip_file" class="form-control-uniform-custom">
                                    <div class="font-italic mt-1">
                                        @if($student->student_kip_file == 1) Melihat Hasil Unggahan Klik <a href="{{asset('storage/admission/fronted/images/student/'. $student->student_nik .'_kip.jpg')}}">Disini</a>
                                        @else <p class="text-danger font-italic mt-1">Berkas belum diunggah</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor PKH :</label>
                                    <input type="text" id="student_pkh_no" class="form-control" value="{{$student->student_pkh_no}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Berkas KIP : </label>
                                    <input type="file" id="student_pkh_file" class="form-control-uniform-custom">
                                    <div class="font-italic mt-1">
                                        @if($student->student_pkh_file == 1) Melihat Hasil Unggahan Klik <a href="{{asset('storage/admission/fronted/images/student/'. $student->student_nik .'_pkh.jpg')}}">Disini</a>
                                        @else <p class="text-danger font-italic mt-1">Berkas belum diunggah</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor KKS :</label>
                                    <input type="text" id="student_kks_no" class="form-control" value="{{$student->student_kks_no}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Berkas KIP : </label>
                                    <input type="file" id="student_kks_file" class="form-control-uniform-custom">
                                    <div class="font-italic mt-1">
                                        @if($student->student_kks_file == 1) Melihat Hasil Unggahan Klik <a href="{{asset('storage/admission/fronted/images/student/'. $student->student_nik .'_kks.jpg')}}">Disini</a>
                                        @else <p class="text-danger font-italic mt-1">Berkas belum diunggah</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">G. INFORMASI SEKOLAH ASAL</h6>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse" href="#schoolcard" role="button"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body collapse" id="schoolcard">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Jenis Asal Sekolah :</label>
                                    <select id="student_school_from" data-placeholder="Pilih Jenis Sekolah" class="form-control select2">
                                        <option></option>
                                        <option value="{{$student->student_school_from}}" selected>{{\App\Models\Student\SchoolFrom::name($student->student_school_from)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Sekolah Asal:</label>
                                    <input type="text" id="student_school_name" class="form-control" value="{{$student->student_school_name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NPSN Sekolah Asal :</label>
                                    <input id="student_school_npsn" class="form-control" value="{{$student->student_school_npsn}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Alamat Sekolah Asal:</label>
                                    <input type="text" id="student_school_address" class="form-control" value="{{$student->student_school_address}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">H. INFORMASI PERSYARATAN</h6>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse" href="#uploadcard" role="button"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body collapse" id="uploadcard">
                    <p class="text-danger font-italic font-weight-semibold text-center">Ukuran maksimal berkas adalah 512 Kb dan berekstensi jpg/jpeg</p>
                    <div class="form-group">
                        <label>Foto Diri : </label>
                        <input type="file" id="student_swaphoto" class="form-control-uniform-custom">
                        <div class="font-italic mt-1">
                        @if($student->student_swaphoto == 1) Melihat Hasil Unggahan Klik <a href="{{asset('storage/admission/fronted/images/student/'. $student->student_nik .'_swaphoto.jpg')}}">Disini</a>
                        @else <p class="text-danger font-italic mt-1">Berkas belum diunggah</p>
                        @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Foto KTP Orangtua : </label>
                        <input type="file" id="student_ktp_photo" class="form-control-uniform-custom">
                        <div class="font-italic mt-1">
                            @if($student->student_ktp_photo == 1) Melihat Hasil Unggahan Klik <a href="{{asset('storage/admission/fronted/images/student/'. $student->student_nik .'_ktp.jpg')}}">Disini</a>
                            @else <p class="text-danger font-italic mt-1">Berkas belum diunggah</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Foto Akta Kelahiran : </label>
                        <input type="file" id="student_akta_photo" class="form-control-uniform-custom">
                        <div class="font-italic mt-1">
                        @if($student->student_akta_photo == 1) Melihat Hasil Unggahan Klik <a href="{{asset('storage/admission/fronted/images/student/'. $student->student_nik .'_akta.jpg')}}">Disini</a>
                        @else <p class="text-danger font-italic mt-1">Berkas belum diunggah</p>
                        @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Foto Kartu Keluarga : </label>
                        <input type="file" id="student_kk_photo" class="form-control-uniform-custom">
                        <div class="font-italic mt-1">
                        @if($student->student_kk_photo == 1) Melihat Hasil Unggahan Klik <a href="{{asset('storage/admission/fronted/images/student/'. $student->student_nik .'_kk.jpg')}}">Disini</a>
                        @else <p class="text-danger font-italic mt-1">Berkas belum diunggah</p>
                        @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Foto Ijazah : </label>
                        <input type="file" id="student_ijazah_photo" class="form-control-uniform-custom">
                        <div class="font-italic mt-1">
                        @if($student->student_ijazah_photo == 1) Melihat Hasil Unggahan Klik <a href="{{asset('storage/admission/fronted/images/student/'. $student->student_nik .'_ijazah.jpg')}}">Disini</a>
                        @else <p class="text-danger font-italic mt-1">Berkas belum diunggah</p>
                        @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Foto SKHUN/SKL : </label>
                        <input type="file" id="student_skhun_photo" class="form-control-uniform-custom">
                        <div class="font-italic mt-1">
                        @if($student->student_skhun_photo == 1) Melihat Hasil Unggahan Klik <a href="{{asset('storage/admission/fronted/images/student/'. $student->student_nik .'_skhun.jpg')}}">Disini</a>
                        @else <p class="text-danger font-italic mt-1">Berkas belum diunggah</p>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">STATUS PENDAFTARAN</h6>
                </div>
                <div class="card-body">
                    @if($compelete == false)
                    <h4 class="text-danger text-center font-weight-semibold">DATA BELUM LENGKAP</h4>
                    <p class="text-justify">Masih terdapat beberapa datang yang belum dilengkapi, silahkan melengkapi terlebih dahulu sebelum mencetak formulir pendaftaran.</p>
                    @else
                    <h4 class="text-success text-center font-weight-semibold">DATA LENGKAP</h4>
                    <p class="text-center">Data sudah lengkap, formulir siap di cetak.</p>
                    @endif
                    <div class="mt-3">
                        <form method="post">
                            <input type="hidden" name="_data" value="{{$student->student_id}}">
                            @csrf
                            <button type="submit" class="btn bg-success btn-labeled btn-labeled-left col-md-12" name="_type" value="print" @if($compelete == false) disabled @endif><b><i class="icon-printer"></i></b> CETAK FORMULIR</button>
                        </form>
                    </div>
                </div>
                <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn bg-info btn-labeled btn-labeled-left" id="update"><b><i class="icon-floppy-disk"></i></b> SIMPAN</button>
                    <a type="submit" class="btn bg-danger btn-labeled btn-labeled-left" id="auth"><b><i class="icon-switch"></i></b> KELUAR</a>
                </div>
            </div>
        </div>
    </div>
@endsection
