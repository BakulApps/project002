@extends('admission.backend.layouts.master', ['title' => 'Pengaturan'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/admission/backend/js/setting.js')}}"></script>
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
                                <a href="#card-app" class="nav-link active" data-toggle="tab">
                                    <i class="icon-screen-full mr-2"></i>
                                    Aplikasi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#card-database" class="nav-link" data-toggle="tab">
                                    <i class="icon-database mr-2"></i>
                                    Database
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body tab-content">
                    <div class="tab-pane fade show active" id="card-app">
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
                            <div class="col-sm-3 col-form-label">Tahun Pelajaran :</div>
                            <div class="col-md-9">
                                <input type="text" id="app_year" value="{{$setting->value('app_year')}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">Logo Aplikasi :</div>
                            <div class="col-md-9">
                                <div class="row">
                                    <a href="#">
                                        <img class="card-img-top img-fluid image-app-view col-md-6"
                                             src="{{asset($setting->value('app_logo') == null ? 'assets/apps/admission/backend/images/placeholder.jpg' : 'storage/admission/backend/images/'.$setting->value('app_logo'))}}" alt="">
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
                            <div class="col-sm-3 col-form-label">Brosur :</div>
                            <div class="col-md-9">
                                <input type="file" id="app_brochure" class="form-control-uniform-custom" required>
                                @if($setting->value('app_brochure') != null)
                                    <div class="mt-1">
                                        <span class="font-italic text-danger">Brosur telah di unggah, untuk melihat <a href="{{asset('storage/admission/backend/images/' . $setting->value('app_brochure'))}}">klik disini</a></span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">Link Tutorial Youtube :</div>
                            <div class="col-md-9">
                                <input type="text" id="app_youtube" class="form-control" value="{{$setting->value('app_youtube')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn bg-info btn-labeled btn-labeled-left" id="app"><b><i class="icon-floppy-disk"></i></b> SIMPAN</button>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="card-database">

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
