@extends('exam.layouts.master', ['title' => 'Pengaturan'])
@section('js')
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/apps/exam/backend/js/setting.js')}}"></script>
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
                            <label class="col-md-4 col-form-label">Nama Sekolah :</label>
                            <div class="col-md-8">
                                <input type="text" id="school_name" class="form-control" value="{{$setting->value('school_name')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Alamat Sekolah :</label>
                            <div class="col-md-8">
                                <textarea id="school_address" class="form-control">{{$setting->value('school_address')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn bg-info btn-labeled btn-labeled-left" id="app"><b><i class="icon-floppy-disk"></i></b> SIMPAN</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="card-bottom-database">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Basis Data :</label>
                            <div class="col-md-9">
                                <select id="database_id" class="form-control select">
                                    <option value="1">Data Pelajaran</option>
                                    <option value="2">Data Tingkat</option>
                                    <option value="3">Data Jurusan</option>
                                    <option value="4">Data Kelas</option>
                                    <option value="5">Data Peserta</option>
                                    <option value="6">Data Jadwal</option>
                                    <option value="7">Data Pengguna</option>
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
                        <img class="card-img-top img-fluid" src="{{asset('storage/exam/images/' . $setting->value('school_logo'))}}" alt="">
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
