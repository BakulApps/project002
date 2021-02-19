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
