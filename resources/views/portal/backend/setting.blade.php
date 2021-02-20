@extends('portal.backend.layouts.master')
@section('js')
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/portal/backend/js/setting.js')}}"></script>
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
                                <a href="#card-bottom-school" class="nav-link" data-toggle="tab">
                                    <i class="icon-office mr-2"></i>
                                    Madrasah
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
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn bg-info btn-labeled btn-labeled-left" id="app"><b><i class="icon-floppy-disk"></i></b> SIMPAN</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="card-bottom-school">
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">Nama Madrasah :</div>
                            <div class="col-md-9">
                                <input type="text" id="sschool_name" value="{{$setting->value('school_name')}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">Telepon Madrasah :</div>
                            <div class="col-md-9">
                                <input type="text" id="school_phone" value="{{$setting->value('school_phone')}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">Email Madrasah :</div>
                            <div class="col-md-9">
                                <input type="text" id="school_email" value="{{$setting->value('school_email')}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">Alamat Madrasah :</div>
                            <div class="col-md-9">
                                <input type="text" id="school_address" value="{{$setting->value('school_address')}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Desa :</label>
                                        <input type="text" id="school_village" value="{{$setting->value('school_village')}}" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Kecamatan :</label>
                                        <input type="text" id="school_village" value="{{$setting->value('school_subdistric')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Kabupaten :</label>
                                        <input type="text" id="school_village" value="{{$setting->value('school_distric')}}" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Propinsi :</label>
                                        <input type="text" id="school_village" value="{{$setting->value('school_province')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">Jam Operasional :</div>
                            <div class="col-md-9">
                                <input type="text" id="school_operational" value="{{$setting->value('school_operational')}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn bg-info btn-labeled btn-labeled-left" id="school"><b><i class="icon-floppy-disk"></i></b> SIMPAN</button>
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
            <div class="card">
                <div class="card-header bg-white">
                    <h6 class="card-title font-weight-semibold">PENGATURAN</h6>
                </div>
                <div class="card-body">
                    <input type="hidden" id="user_id" value="{{auth('portal')->user()->user_id}}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Nama Lengkap :</label>
                                <input type="text" id="user_fullname" value="{{auth('portal')->user()->user_fullname}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Nama Pengguna : </label>
                                <input type="text" id="user_name" value="{{auth('portal')->user()->user_name}}" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label>Kata Sandi :</label>
                                <input type="password" id="user_pass" placeholder="Ex. *************" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Email : </label>
                                <input type="text" id="user_email" value="{{auth('portal')->user()->user_email}}" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label>Tipe Pengguna : </label>
                                <select id="user_role" class="form-control select" data-placeholder="Pilih Tipe Pengguna">
                                    <option></option>
                                    <option value="1" {{auth('portal')->user()->user_role == 1 ? 'selected' : null}}>Administrator</option>
                                    <option value="2" {{auth('portal')->user()->user_role == 2 ? 'selected' : null}}>Penulis</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Facebook :</label>
                                <input type="text" id="user_facebook" value="{{auth('portal')->user()->user_facebook}}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>Instagram :</label>
                                <input type="text" id="user_instagram" value="{{auth('portal')->user()->user_instagram}}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>Twitter :</label>
                                <input type="text" id="user_twitter" value="{{auth('portal')->user()->user_twitter}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Diskripsi :</label>
                                <textarea id="user_desc" class="form-control" rows="4">{{auth('portal')->user()->user_desc}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white text-right">
                    <button type="submit" class="btn bg-info btn-labeled btn-labeled-left" id="submit"><b><i class="icon-floppy-disk"></i></b> SIMPAN</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <a href="#">
                        <img class="card-img-top img-fluid image-view" src="{{asset(auth('portal')->user()->user_image == null ? 'assets/portal/backend/images/placeholder.jpg' : auth('portal')->user()->user_image)}}" alt="">
                    </a>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="file" id="user_image" class="form-control-uniform-custom" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
