@extends('admission.fronted.layouts.master', ['title' => 'Pendaftaran'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/styling/uniform.min.js')}}"></script>
    <script src="{{asset("assets/js/plugins/selects/select2.min.js")}}"></script>
    <script src="{{asset('assets/js/plugins/pickers/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset("assets/apps/admission/fronted/js/register.js")}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Pendaftaran</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">FORMULIR PENDAFTARAN</h6>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="font-weight-semibold">A. Informasi Pribadi</h6>
                    <div class="col-md-12 offset-md-0">
                        <div class="form-group">
                            <label>Nama Lengkap :</label>
                            <input type="text" id="student_name" class="form-control" placeholder="Ex. Muhammad Bahrudin Yusuf">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Induk Siswa Nasional :</label>
                                    <input type="text" id="student_nisn" placeholder="Ex. 0034786736" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Induk Kependudukan :</label>
                                    <input type="text" id="student_nik" placeholder="Ex. 1234512345123456" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir:</label>
                                    <input type="text" id="student_birthplace" class="form-control" placeholder="Ex. Jepara">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="text" id="student_birthday" class="form-control daterange">
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
                                        <option></option>
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
                                    <input type="text" id="student_siblingplace" class="form-control" placeholder="Ex. 2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah Saudara :</label>
                                    <input type="text" id="student_sibling" class="form-control" placeholder="Ex. 3">
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
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Hobi :</label>
                                    <select id="student_hobby" data-placeholder="Pilih Hobi" class="form-control select2">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Cita-cita :</label>
                                    <select id="student_purpose" data-placeholder="Pilih Cita-cita" class="form-control select2">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email :</label>
                                    <input type="text" id="student_email" class="form-control" placeholder="Ex. arifmuntaha@gmail.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor HP :</label>
                                    <input type="text" id="student_phone" class="form-control" placeholder="Ex. 6282229366509">
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
                                                    <input type="checkbox" class="form-check-input-styled" id="student_im_hepatitis" value="1" data-fouc>
                                                    Hepatitis
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input-styled" id="student_im_polio" data-fouc>
                                                    Polio
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input-styled" id="student_im_bcg" data-fouc>
                                                    BCG
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input-styled" id="student_im_campak" data-fouc>
                                                    Campak
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input-styled" id="student_im_dpt" value="1" data-fouc>
                                                    DPT
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input-styled" id="student_im_covid" value="1" data-fouc>
                                                    Covid-19
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="font-weight-semibold">B. Informasi Tempat Tinggal</h6>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Jenis Tempat Tinggal Siswa :</label>
                                    <select id="student_residence" data-placeholder="Pilih Tempat Tinggal" class="form-control select2">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Alamat :</label>
                                    <input type="text" id="student_address" class="form-control" placeholder="Jl. Diponegoro No. 9">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Propinsi :</label>
                                    <select id="student_province" data-placeholder="Pilih Propinsi" class="form-control select2">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kabupaten/Kota :</label>
                                    <select id="student_distric" data-placeholder="Pilih Kebupaten/Kota" class="form-control select2">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kecamantan :</label>
                                    <select id="student_subdistric" data-placeholder="Pilih Kecamatan" class="form-control select2">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keluranan/Desa :</label>
                                    <select id="student_village" data-placeholder="Pilih Kelurahan/Desa" class="form-control select2">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kodepos :</label>
                                    <input id="student_postal" placeholder="Ex. 59463" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jarak Tempat Tinggal :</label>
                                    <select id="student_distance" data-placeholder="Pilih Jarak Tempat Tinggal" class="form-control select2">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Transportasi yang Dipakai :</label>
                                    <select id="student_transport" data-placeholder="Pilih Transportasi" class="form-control select2">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Waktu Tempuh (Menit) :</label>
                                    <select id="student_travel" data-placeholder="Pilih Waktu Tempuh" class="form-control select2">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="font-weight-semibold">C. Informasi Program Pilihan</h6>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Program Pilihan :</label>
                                    <select id="student_program" data-placeholder="Pilih Program" class="form-control select2">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Boarding/Non Boarding :</label>
                                    <select id="student_boarding" data-placeholder="Pilih Program" class="form-control select2">
                                        <option></option>
                                        <option value="1">Ya</option>
                                        <option value="2">Tidak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label text-justify">
                                            <input type="checkbox" class="form-check-input-styled-success" id="check_agreement" data-fouc>
                                            Semua data yang saya masukkan adalah benar dan tidak ada manipulasi. Jika terjadi kesalahan
                                            saya bersedia mempertanggungjawabkan sesuai dengan ketentuan yang berlaku.
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn bg-info btn-labeled btn-labeled-left" id="submit" value="store"><b><i class="icon-paperplane"></i></b> Kirim Pendaftaran</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">LENGKAPI PENDAFTARAN</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>NISN/NIK:</label>
                        <input type="text" id="student_nisn_login" placeholder="Ex. 0034786736" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="text" id="student_birthday_login" class="form-control daterange">
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn bg-info btn-labeled btn-labeled-left" id="auth"><b><i class="icon-switch"></i></b> MASUK</button>
                </div>
            </div>
        </div>
    </div>
@endsection
