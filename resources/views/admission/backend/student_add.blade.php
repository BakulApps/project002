@extends('admission.backend.layouts.master', ['title' => 'Data Siswa'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pickers/daterangepicker.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/admission/backend/js/student_add.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Siswa</span>
    <span class="breadcrumb-item active">Tambah Siswa</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white header-elements-sm-inline">
                    <h5 class="card-title font-weight-semibold">TAMBAH SISWA</h5>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-header bg-white header-elements-inline">
                            <h6 class="card-title font-weight-semibold">A. INFORMASI PRIBADI</h6>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a class="list-icons-item" data-action="collapse"></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 offset-md-0">
                                <input type="hidden" id="student_id" value="">
                                <div class="form-group">
                                    <label for="student_name">Nama Lengkap :</label>
                                    <input type="text" id="student_name" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor Induk Siswa Nasional :</label>
                                            <input type="text" id="student_nisn" value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor Induk Kependudukan :</label>
                                            <input type="text" id="student_nik" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tempat Lahir:</label>
                                            <input type="text" id="student_birthplace" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="text" id="student_birthday" class="form-control daterange" value="">
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
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Agama :</label>
                                            <select id="student_religion" data-placeholder="Pilih Agama" class="form-control select2">
                                                <option value=""></option>
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
                                            <input type="text" id="student_siblingplace" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jumlah Saudara :</label>
                                            <input type="text" id="student_sibling" class="form-control" value="">
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
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Hobi :</label>
                                            <select id="student_hobby" data-placeholder="Pilih Hobi" class="form-control select2">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Cita-cita :</label>
                                            <select id="student_purpose" data-placeholder="Pilih Cita-cita" class="form-control select2">
                                                <option value=""></option>
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
                                            <input type="text" id="student_email" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor HP :</label>
                                            <input type="text" id="student_phone" class="form-control" value="">
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
                                                        <label class="form-check-label"><input type="checkbox" class="form-check-input-styled" id="student_im_hepatitis">Hepatitis</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label"><input type="checkbox" class="form-check-input-styled" id="student_im_polio">Polio</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label"><input type="checkbox" class="form-check-input-styled" id="student_im_bcg">BCG</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label"><input type="checkbox" class="form-check-input-styled" id="student_im_campak">Campak</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label"><input type="checkbox" class="form-check-input-styled" id="student_im_dpt">DPT</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label"><input type="checkbox" class="form-check-input-styled" id="student_im_covid">Covid-19</label>
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
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Alamat :</label>
                                            <input type="text" id="student_address" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Propinsi :</label>
                                            <select id="student_province" data-placeholder="Pilih Propinsi" class="form-control select2">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kabupaten/Kota :</label>
                                            <select id="student_distric" data-placeholder="Pilih Kebupaten/Kota" class="form-control select2">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kecamantan :</label>
                                            <select id="student_subdistric" data-placeholder="Pilih Kecamatan" class="form-control select2">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Keluranan/Desa :</label>
                                            <select id="student_village" data-placeholder="Pilih Kelurahan/Desa" class="form-control select2">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kodepos :</label>
                                            <input id="student_postal" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jarak Tempat Tinggal :</label>
                                            <select id="student_distance" data-placeholder="Pilih Jarak Tempat Tinggal" class="form-control select2">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Transportasi yang Dipakai :</label>
                                            <select id="student_transport" data-placeholder="Pilih Transportasi" class="form-control select2">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Waktu Tempuh (Menit) :</label>
                                            <select id="student_travel" data-placeholder="Pilih Waktu Tempuh" class="form-control select2">
                                                <option value=""></option>
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
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Boarding/Non Boarding :</label>
                                            <select id="student_boarding" data-placeholder="Pilih Boarding" class="form-control select2">
                                                <option value="1" >Ya</option>
                                                <option value="2" >Tidak</option>
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
                                            <input id="student_no_kk" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Kepala Keluarga :</label>
                                            <input id="student_head_family" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Ayah :</label>
                                            <input id="student_father_name" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Ibu :</label>
                                            <input id="student_mother_name" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status Ayah :</label>
                                            <select id="student_father_status" data-placeholder="Pilih Status" class="form-control select2">
                                                <option value="" selected></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status Ibu :</label>
                                            <select id="student_mother_status" data-placeholder="Pilih Status" class="form-control select2">
                                                <option value="" selected></option>
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
                                                    <input id="student_father_birthplace" class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Lahir Ayah :</label>
                                                    <input type="text" id="student_father_birthday" class="form-control daterange" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tempat Lahir Ibu:</label>
                                                    <input id="student_mother_birthplace" class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Lahir Ibu :</label>
                                                    <input type="text" id="student_mother_birthday" class="form-control daterange" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIK Ayah :</label>
                                            <input id="student_father_nik" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIK Ibu :</label>
                                            <input id="student_mother_nik" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pendidikan Ayah :</label>
                                            <select id="student_father_study" data-placeholder="Pilih Pendidikan" class="form-control select2">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pendidikan Ibu :</label>
                                            <select id="student_mother_study" data-placeholder="Pilih Pendidikan" class="form-control select2">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pekerjaan Ayah :</label>
                                            <select id="student_father_job" data-placeholder="Pilih Pekerjaan" class="form-control select2">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pekerjaan Ibu :</label>
                                            <select id="student_mother_job" data-placeholder="Pilih Pekerjaan" class="form-control select2">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Penghasilan Ayah :</label>
                                            <select id="student_father_earning" data-placeholder="Pilih Penghasilan" class="form-control select2">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Penghasilan Ibu :</label>
                                            <select id="student_mother_earning" data-placeholder="Pilih Penghasilan" class="form-control select2">
                                                <option value="" ></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor HP Ayah :</label>
                                            <input id="student_father_phone" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor HP Ibu :</label>
                                            <input id="student_mother_phone" class="form-control" value="">
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
                                            <input id="student_guard_name" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIK Wali :</label>
                                            <input id="student_guard_nik" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tempat Lahir Wali :</label>
                                            <input id="student_guard_birthplace" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tanggal Lahir Wali :</label>
                                            <input type="text" id="student_guard_birthday" class="form-control daterange" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pendidikan Wali :</label>
                                            <select id="student_guard_study" data-placeholder="Pilih Pendidikan" class="form-control select2">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pekerjaan Wali :</label>
                                            <select id="student_guard_job" data-placeholder="Pilih Pekerjaan" class="form-control select2">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Penghasilan Wali :</label>
                                            <select id="student_guard_earning" data-placeholder="Pilih Penghasilan" class="form-control select2">
                                                <option value="" ></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nomor HP Wali :</label>
                                            <input id="student_guard_phone" class="form-control" value="">
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
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Alamat :</label>
                                            <input type="text" id="student_home_address" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kodepos :</label>
                                            <input id="student_home_postal" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Propinsi :</label>
                                            <select id="student_home_province" data-placeholder="Pilih Propinsi" class="form-control select2">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kabupaten/Kota :</label>
                                            <select id="student_home_distric" data-placeholder="Pilih Kebupaten/Kota" class="form-control select2">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kecamantan :</label>
                                            <select id="student_home_subdistric" data-placeholder="Pilih Kecamatan" class="form-control select2">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Keluranan/Desa :</label>
                                            <select id="student_home_village" data-placeholder="Pilih Kelurahan/Desa" class="form-control select2">
                                                <option></option>
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
                                            <label for="student_kip_no">Nomor KIP :</label>
                                            <input type="text" id="student_kip_no" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Berkas KIP</label>
                                            <select id="student_kip_file" data-placeholder="Pilih Status Berkas.." class="form-control select2">
                                                <option></option>
                                                <option value="1">1. Berkas Ada</option>
                                                <option value="2">1. Berkas Tidak Ada</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor PKH :</label>
                                            <input type="text" id="student_pkh_no" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Berkas PKH : </label>
                                            <select id="student_pkh_file" data-placeholder="Pilih Status Berkas.." class="form-control select2">
                                                <option></option>
                                                <option value="1">1. Berkas Ada</option>
                                                <option value="2">1. Berkas Tidak Ada</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor KKS :</label>
                                            <input type="text" id="student_kks_no" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Berkas KKS : </label>
                                            <select id="student_kks_file" data-placeholder="Pilih Status Berkas.." class="form-control select2">
                                                <option></option>
                                                <option value="1">1. Berkas Ada</option>
                                                <option value="2">1. Berkas Tidak Ada</option>
                                            </select>
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
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Sekolah Asal:</label>
                                            <input type="text" id="student_school_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NPSN Sekolah Asal :</label>
                                            <input id="student_school_npsn" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Alamat Sekolah Asal:</label>
                                            <input type="text" id="student_school_address" class="form-control">
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="student_swaphoto">Berkas Foto</label>
                                        <select id="student_swaphoto" data-placeholder="Pilih Status Berkas.." class="form-control select2">
                                            <option></option>
                                            <option value="1">1. Berkas Ada</option>
                                            <option value="2">1. Berkas Tidak Ada</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="student_ktp_photo">Berkas KTP</label>
                                        <select id="student_ktp_photo" data-placeholder="Pilih Status Berkas.." class="form-control select2">
                                            <option></option>
                                            <option value="1">1. Berkas Ada</option>
                                            <option value="2">1. Berkas Tidak Ada</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="student_akta_photo">Berkas Akta Kelahiran</label>
                                        <select id="student_akta_photo" data-placeholder="Pilih Status Berkas.." class="form-control select2">
                                            <option></option>
                                            <option value="1">1. Berkas Ada</option>
                                            <option value="2">1. Berkas Tidak Ada</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="student_kk_photo">Berkas Kartu Keluarga</label>
                                        <select id="student_kk_photo" data-placeholder="Pilih Status Berkas.." class="form-control select2">
                                            <option></option>
                                            <option value="1">1. Berkas Ada</option>
                                            <option value="2">1. Berkas Tidak Ada</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="student_ijazah_photo">Berkas Ijazah</label>
                                        <select id="student_ijazah_photo" data-placeholder="Pilih Status Berkas.." class="form-control select2">
                                            <option></option>
                                            <option value="1">1. Berkas Ada</option>
                                            <option value="2">1. Berkas Tidak Ada</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="student_skhun_photo">Berkas SKL/SKHUN</label>
                                        <select id="student_skhun_photo" data-placeholder="Pilih Status Berkas.." class="form-control select2">
                                            <option></option>
                                            <option value="1">1. Berkas Ada</option>
                                            <option value="2">1. Berkas Tidak Ada</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
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
                        <button type="submit" class="btn bg-success btn-labeled btn-labeled-left col-md-12" id="print" @if($compelete == false) disabled @endif><b><i class="icon-printer"></i></b> CETAK FORMULIR</button>
                    </div>
                </div>
                <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn bg-info btn-labeled btn-labeled-left" id="store"><b><i class="icon-floppy-disk"></i></b> SIMPAN</button>
                    <a type="submit" class="btn bg-danger btn-labeled btn-labeled-left" id="auth"><b><i class="icon-switch"></i></b> KELUAR</a>
                </div>
            </div>
        </div>
    </div>
@endsection
