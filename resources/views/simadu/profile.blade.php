@extends('simadu.layouts.master', ['title' => 'Informasi Pribadi'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pickers/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/simadu/js/profile.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Informasi Pribadi</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white pb-0 pt-sm-0 pr-sm-0 header-elements-sm-inline">
                    <h6 class="card-title">INFORMASI</h6>
                    <div class="header-elements">
                        <ul class="nav nav-tabs nav-tabs-bottom card-header-tabs mx-0">
                            <li class="nav-item">
                                <a href="#card-personal" class="nav-link active" data-toggle="tab">
                                    <i class="icon-user mr-2"></i>
                                    Pribadi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#card-parent" class="nav-link" data-toggle="tab">
                                    <i class="icon-users mr-2"></i>
                                    Orang Tua
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#card-academic" class="nav-link" data-toggle="tab">
                                    <i class="icon-chart mr-2"></i>
                                    Akademik
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#card-scholarship" class="nav-link" data-toggle="tab">
                                    <i class="icon-credit-card mr-2"></i>
                                    Bantuan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#card-file" class="nav-link" data-toggle="tab">
                                    <i class="icon-file-empty mr-2"></i>
                                    Berkas
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <input type="hidden" id="student_id" value="{{$student->student_id}}">
                <div class="card-body tab-content">
                    <div class="tab-pane fade show active" id="card-personal">
                        <div class="row">
                            <div class="col-md-12 offset-md-0">
                                <div class="form-group">
                                    <label>Nama Lengkap :</label>
                                    <input type="text" id="student_name" class="form-control" value="{{$student->student_name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nomor Induk Siswa Nasional :</label>
                                    <input type="text" id="student_nisn" value="{{$student->student_nisn}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nomor Induk Siswa Madrasah :</label>
                                    <input type="text" id="student_nisn" value="{{$student->student_nism}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Kewarganegaraan : </label>
                                    <select id="student_civic" class="form-control select2 select-civic">
                                        <option value="{{$student->student_civic}}">{{\App\Models\Master\Civic::name($student->student_civic)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nomor Induk Kependudukan :</label>
                                    <input type="text" id="student_nik" value="{{$student->student_nik}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Jenis Kelamin : </label>
                                    <select id="student_gender" data-placeholder="Pilih Jenis Kelamin" class="form-control select2">
                                        <option value="{{$student->student_gender}}">{{\App\Models\Master\Gender::name($student->student_gender)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nomor Handphone :</label>
                                            <input type="text" id="student_phone" class="form-control" value="{{$student->student_phone}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Alamat Email :</label>
                                            <input type="text" id="student_mail" class="form-control" value="{{$student->student_mail}}">
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
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5 class="font-weight-semibold">TEMPAT TINGGAL</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Status Tempat Tinggal :</label>
                                    <select id="student_residence" data-placeholder="Pilih Tempat Tinggal" class="form-control select2">
                                        <option value="{{$student->student_residence}}">{{\App\Models\Student\Residence::name($student->student_residence)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Propinsi :</label>
                                    <select id="student_province" data-placeholder="Pilih Propinsi" class="form-control select2 select-province" {{$student->student_residence == 1 ? 'disabled' : null}}>
                                        <option value="{{$student->student_province}}">{{\App\Models\Master\Territory::province($student->student_province)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kabupaten/Kota :</label>
                                    <select id="student_distric" data-placeholder="Pilih Kebupaten/Kota" class="form-control select2 select-distric" {{$student->student_residence == 1 ? 'disabled' : null}}>
                                        <option value="{{$student->student_distric}}">{{\App\Models\Master\Territory::distric($student->student_distric)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kecamantan :</label>
                                    <select id="student_subdistric" data-placeholder="Pilih Kecamatan" class="form-control select2 select-subdistric" {{$student->student_residence == 1 ? 'disabled' : null}}>
                                        <option value="{{$student->student_subdistric}}">{{\App\Models\Master\Territory::subdistric($student->student_subdistric)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keluranan/Desa :</label>
                                    <select id="student_village" data-placeholder="Pilih Kelurahan/Desa" class="form-control select2 select-village" {{$student->student_residence == 1 ? 'disabled' : null}}>
                                        <option value="{{$student->student_village}}">{{\App\Models\Master\Territory::village($student->student_subdistric, $student->student_village)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Alamat :</label>
                                    <input type="text" id="student_address" class="form-control" value="{{$student->student_address}}" {{$student->student_residence == 1 ? 'disabled' : null}}>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kodepos :</label>
                                    <input type="text" id="student_postal" class="form-control" value="{{$student->student_postal}}" {{$student->student_residence == 1 ? 'disabled' : null}}>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Transportasi ke Sekolah :</label>
                                    <select id="student_transport" data-placeholder="Pilih Transportasi" class="form-control select2">
                                        <option value="{{$student->student_transport}}">{{\App\Models\Master\Transport::name($student->student_transport)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jarak Tempat Tinggal :</label>
                                    <select id="student_distance" data-placeholder="Pilih Jarak Tempat Tinggal" class="form-control select2">
                                        <option value="{{$student->student_distance}}">{{\App\Models\Master\Distance::name($student->student_distance)}}</option>
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
                        <h5 class="font-weight-semibold">PRA SEKOLAH</h5>
                        <div class="row">
                            <div class="col-md-6">
                               <div class="form-group">
                                   <div class="form-check">
                                       <label class="form-check-label">
                                           <input type="checkbox" class="form-check-input-styled" id="student_paud">
                                           {{$student->student_paud == 1 ? 'checked' : null}}Pernah PAUD
                                       </label>
                                   </div>
                               </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input-styled" id="student_tk">
                                            {{$student->student_tk == 1 ? 'checked' : null}}Pernah TK
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5 class="font-weight-semibold">IMUNISASI</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input-styled" id="student_paud">
                                            {{$student->student_im_hepatitis == 1 ? 'checked' : null}} Hepatitis B
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input-styled" id="student_tk">
                                            {{$student->student_im_polio == 1 ? 'checked' : null}} Polio
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input-styled" id="student_tk">
                                            {{$student->student_im_bcg == 1 ? 'checked' : null}} BGC
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input-styled" id="student_tk">
                                        {{$student->student_im_campak == 1 ? 'checked' : null}} Campak
                                    </label>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input-styled" id="student_tk">
                                        {{$student->student_im_dpt == 1 ? 'checked' : null}} DPT
                                    </label>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input-styled" id="student_tk">
                                        {{$student->student_im_covid == 1 ? 'checked' : null}} Covid
                                    </label>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn bg-info btn-labeled btn-labeled-left" id="submit" value="personal"><b><i class="icon-floppy-disk"></i></b> Simpan Perubahan</button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="card-parent">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Kartu Keluarga :</label>
                                    <input id="student_kk_no" class="form-control" value="{{$student->student_kk_no}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Kepala Keluarga :</label>
                                    <input id="student_head_family" class="form-control" value="{{$student->student_head_family}}">
                                </div>
                            </div>
                        </div>
                        <h5 class="font-weight-semibold">Orang Tua</h5>
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
                                    <select id="student_father_status" data-placeholder="Pilih Status" class="form-control select2 select-parent-status">
                                        <option value="{{$student->student_father_status}}" selected>{{\App\Models\Student\ParentStatus::name($student->student_father_status)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Ibu :</label>
                                    <select id="student_mother_status" data-placeholder="Pilih Status" class="form-control select2 select-parent-status">
                                        <option value="{{$student->student_mother_status}}" selected>{{\App\Models\Student\ParentStatus::name($student->student_mother_status)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kewarganegaraan Ayah :</label>
                                    <select id="student_father_civic" data-placeholder="Pilih Kewarganegaraan" class="form-control select2 select-civic">
                                        <option value="{{$student->student_father_civic}}" selected>{{\App\Models\Master\Civic::name($student->student_father_civic)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kewarganegaraan Ibu :</label>
                                    <select id="student_mother_civic" data-placeholder="Pilih Kewarganegaraan" class="form-control select2 select-civic">
                                        <option value="{{$student->student_mother_civic}}" selected>{{\App\Models\Master\Civic::name($student->student_mother_civic)}}</option>
                                    </select>
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
                                    <label>Tempat Lahir Ayah :</label>
                                    <input type="text" id="student_father_birthplace" class="form-control" value="{{$student->student_father_birthplace}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir Ibu :</label>
                                    <input type="text" id="student_mother_birthplace" class="form-control" value="{{$student->student_mother_birthplace}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir Ayah :</label>
                                    <input type="text" id="student_father_birthday" class="form-control daterange" value="{{$student->fatherbirthday()}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir Ibu :</label>
                                    <input type="text" id="student_mother_birthday" class="form-control daterange" value="{{$student->motherbirthday()}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pendidikan Ayah :</label>
                                    <select id="student_father_study" data-placeholder="Pilih Pendidikan" class="form-control select2 select-parent-study">
                                        <option value="{{$student->student_father_study}}" selected>{{\App\Models\Master\Study::name($student->student_father_study)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pendidikan Ibu :</label>
                                    <select id="student_mother_study" data-placeholder="Pilih Pendidikan" class="form-control select2 select-parent-study">
                                        <option value="{{$student->student_mother_study}}" selected>{{\App\Models\Master\Study::name($student->student_mother_study)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pekerjaan Ayah :</label>
                                    <select id="student_father_job" data-placeholder="Pilih Pekerjaan" class="form-control select2 select-parent-job">
                                        <option value="{{$student->student_father_job}}" selected>{{\App\Models\Master\Job::name($student->student_father_job)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pekerjaan Ibu :</label>
                                    <select id="student_mother_job" data-placeholder="Pilih Pekerjaan" class="form-control select2 select-parent-job">
                                        <option value="{{$student->student_mother_job}}" selected>{{\App\Models\Master\Job::name($student->student_mother_job)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penghasilan Ayah :</label>
                                    <select id="student_father_earning" data-placeholder="Pilih Penghasilan" class="form-control select2  select-parent-earning">
                                        <option value="{{$student->student_father_earning}}" selected>{{\App\Models\Master\Earning::name($student->student_father_earning)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penghasilan Ibu :</label>
                                    <select id="student_mother_earning" data-placeholder="Pilih Penghasilan" class="form-control select2 select-parent-earning">
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
                        <h5 class="font-weight-semibold">Tempat Tinggal</h5>
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
                                    <label>Propinsi :</label>
                                    <select id="student_home_province" data-placeholder="Pilih Propinsi" class="form-control select2 select-province">
                                        <option value="{{$student->student_home_province}}">{{\App\Models\Master\Territory::province($student->student_home_province)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kabupaten/Kota :</label>
                                    <select id="student_home_distric" data-placeholder="Pilih Kebupaten/Kota" class="form-control select2 select-distric">
                                        <option value="{{$student->student_home_distric}}">{{\App\Models\Master\Territory::distric($student->student_home_distric)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kecamantan :</label>
                                    <select id="student_home_subdistric" data-placeholder="Pilih Kecamatan" class="form-control select2 select-subdistric">
                                        <option value="{{$student->student_home_subdistric}}">{{\App\Models\Master\Territory::subdistric($student->student_home_subdistric)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keluranan/Desa :</label>
                                    <select id="student_home_village" data-placeholder="Pilih Kelurahan/Desa" class="form-control select2 select-village">
                                        <option value="{{$student->student_home_village}}">{{\App\Models\Master\Territory::village($student->student_home_subdistric, $student->student_home_village)}}</option>
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
                        <h5 class="font-weight-semibold">Wali Siswa</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input-styled" id="same_father" name="radio_regent" value="1">Sama Dengan Ayah Kandung
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input-styled" id="same_mother" name="radio_regent" value="2">Sama Dengan Ibu Kandung
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input-styled" id="same_other" name="radio_regent" value="3">Lainnya
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Wali :</label>
                                    <input id="student_regent_name" class="form-control" value="{{$student->student_regent_name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Wali :</label>
                                    <select id="student_regent_status" data-placeholder="Pilih Status" class="form-control select2 select-parent-status">
                                        <option value="{{$student->student_regent_status}}" selected>{{\App\Models\Student\ParentStatus::name($student->student_regent_status)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kewarganegaraan Wali :</label>
                                    <select id="student_regent_civic" data-placeholder="Pilih Status" class="form-control select2 select-civic">
                                        <option value="{{$student->student_regent_civic}}" selected>{{\App\Models\Master\Civic::name($student->student_regent_civic)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NIK Wali :</label>
                                    <input id="student_regent_nik" class="form-control" value="{{$student->student_father_nik}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir Wali :</label>
                                    <input type="text" id="student_regent_birthplace" class="form-control" value="{{$student->student_regent_birthplace}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir Wali :</label>
                                    <input type="text" id="student_regent_birthday" class="form-control daterange" value="{{$student->regentbirthday()}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pendidikan Wali :</label>
                                    <select id="student_regent_study" data-placeholder="Pilih Pendidikan" class="form-control select2 select-parent-study">
                                        <option value="{{$student->student_regent_study}}" selected>{{\App\Models\Master\Study::name($student->student_regent_study)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pekerjaan Wali :</label>
                                    <select id="student_regent_job" data-placeholder="Pilih Pekerjaan" class="form-control select2 select-parent-job">
                                        <option value="{{$student->student_regent_job}}" selected>{{\App\Models\Master\Job::name($student->student_regent_job)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penghasilan Wali :</label>
                                    <select id="student_regent_earning" data-placeholder="Pilih Penghasilan" class="form-control select2  select-parent-earning">
                                        <option value="{{$student->student_regent_earning}}" selected>{{\App\Models\Master\Earning::name($student->student_regent_earning)}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor HP Wali :</label>
                                    <input id="student_regent_phone" class="form-control" value="{{$student->student_regent_phone}}">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn bg-info btn-labeled btn-labeled-left" id="parent" value="update"><b><i class="icon-floppy-disk"></i></b> Simpan Perubahan</button>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="card-bottom-tab3">
                        This is the third card tab content
                    </div>

                    <div class="tab-pane fade" id="card-bottom-tab4">
                        This is the fourth card tab content
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
