@extends('graduate.layouts.master', ['title' => 'Pengaturan'])
@section('js')
    <script src="{{asset('assets/js/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pickers/daterangepicker.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/apps/graduate/backend/js/setting.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Pengaturan</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white pb-0 pt-sm-0 pr-sm-0 header-elements-sm-inline">
                    <h6 class="card-title">PENGATURAN</h6>
                    <div class="header-elements">
                        <ul class="nav nav-tabs nav-tabs-bottom card-header-tabs mx-0">
                            <li class="nav-item">
                                <a href="#card-bottom-app" class="nav-link active" data-toggle="tab"><i class="icon-file-empty mr-2"></i>Aplikasi</a>
                            </li>
                            <li class="nav-item">
                                <a href="#card-bottom-graduate" class="nav-link" data-toggle="tab"><i class="icon-calendar mr-2"></i>Kelulusan</a>
                            </li>
                            <li class="nav-item">
                                <a href="#card-bottom-database" class="nav-link" data-toggle="tab"><i class="icon-database mr-2"></i>Basis Data</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body tab-content">
                    <div class="tab-pane fade show active" id="card-bottom-app">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Nama Aplikasi :</label>
                            <div class="col-md-8">
                                <input type="text" id="app_name" class="form-control" value="{{$setting->value('app_name')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Sub-Nama Aplikasi :</label>
                            <div class="col-md-8">
                                <input type="text" id="app_alias" class="form-control" value="{{$setting->value('app_alias')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn bg-info btn-labeled btn-labeled-left" id="app"><b><i class="icon-floppy-disk"></i></b>SIMPAN</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="card-bottom-graduate">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Format Nomor Surat :</label>
                            <div class="col-md-8">
                                <input type="text" id="announcement_letter" class="form-control" value="{{$setting->value('announcement_letter')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Tanggal Pengumuman :</label>
                            <div class="col-md-8">
                                <input type="text" id="announcement_date" class="form-control daterange" value="{{$setting->value('announcement_date')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Bobot Penilaian Harian % :</label>
                            <div class="col-md-4">
                                <input type="text" id="value_semester" class="form-control" value="{{$setting->value('value_semester')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Bobot Penilaian Ujian % :</label>
                            <div class="col-md-4">
                                <input type="text" id="value_exam" class="form-control" value="{{$setting->value('value_exam')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn bg-info btn-labeled btn-labeled-left" id="announcement"><b><i class="icon-floppy-disk"></i></b>SIMPAN</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="card-bottom-database">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Basis Data :</label>
                            <div class="col-md-9">
                                <select id="database_id" class="form-control select">
                                    <option value="1">Tahun Pelajaran</option>
                                    <option value="2">Data Pelajaran</option>
                                    <option value="3">Peserta Didik</option>
                                    <option value="4">Nilai Semester</option>
                                    <option value="5">Nilai Ujian</option>
                                    <option value="6">Data Pengumuman</option>
                                </select>
                                <p class="text-danger font-italic mt-2">Perhatian! data yang terpilih akan terhapus semua.</p>
                            </div>
                            </p>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <button type="submit" class="btn bg-danger btn-labeled btn-labeled-left" id="database"><b><i class="icon-trash"></i></b> KOSONGKAN</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Logo Sekolah</h5>
                </div>
                <div class="card-body">
                    <a href="#">
                        <img class="card-img-top img-fluid" src="{{asset('storage/graduate/images/' . $setting->value('school_logo'))}}" alt="">
                    </a>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="file" id="school_logo" class="form-control-uniform-custom" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
