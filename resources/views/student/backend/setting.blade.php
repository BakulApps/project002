@extends('student.layouts.master', ['title' => 'Pengaturan'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/student/backend/js/setting.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Pengaturan</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white pb-0 pt-sm-0 pr-sm-0 header-elements-sm-inline">
                    <h6 class="card-title font-weight-semibold">PENGATURAN</h6>
                    <div class="header-elements">
                        <ul class="nav nav-tabs nav-tabs-bottom card-header-tabs mx-0">
                            <li class="nav-item">
                                <a href="#card-bottom-app" class="nav-link active" data-toggle="tab">
                                    <i class="icon-screen-full mr-2"></i>
                                    Aplikasi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#card-bottom-database" class="nav-link" data-toggle="tab">
                                    <i class="icon-database mr-2"></i>
                                    Database
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body tab-content">
                    <div class="tab-pane fade show active" id="card-bottom-app">
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">Nama Aplikasi :</div>
                            <div class="col-md-9">
                                <input type="text" id="app_name" value="{{$setting->value('app_name')}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">Nama Singkatan :</div>
                            <div class="col-md-9">
                                <input type="text" id="app_alias" value="{{$setting->value('app_alias')}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">Logo Aplikasi :</div>
                            <div class="col-md-9">
                                <div class="row">
                                    <a href="#">
                                        <img class="card-img-top img-fluid image-app-view col-md-6"
                                             src="{{asset($setting->value('app_logo') == null ? 'assets/apps/student/images/placeholder.jpg' : 'storage/student/images/'.$setting->value('app_logo'))}}"
                                             alt="">
                                    </a>
                                </div>
                                <hr>
                                <input type="file" id="app_logo" class="form-control-uniform-custom" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">Diskripsi Aplikasi :</div>
                            <div class="col-md-9">
                                <textarea id="app_desc" class="form-control">{{$setting->value('app_desc')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn bg-info btn-labeled btn-labeled-left" id="app"><b><i class="icon-floppy-disk"></i></b> SIMPAN</button>
                            </div>
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h6 class="card-title font-weight-semibold">Informasi</h6>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
@endsection
