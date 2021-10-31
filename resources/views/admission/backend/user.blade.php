@extends('admission.backend.layouts.master', ['title' => 'Pengguna'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/admission/backend/js/user.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Pengguna</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">DATA PENGGUNA</h6>
                    <div class="header-elements">
                        <button type="button" class="btn btn-primary btn-labeled btn-labeled-left font-weight-semibold" data-toggle="modal" data-target="#modal-user"><b><i class="icon-user-plus"></i> </b>TAMBAH</button>
                    </div>
                </div>
                <table class="table datatable-user table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA LENGKAP</th>
                        <th>NAMA PENGGUNA</th>
                        <th>KATA SANDI</th>
                        <th>EMAIL</th>
                        <th>HAK AKSES</th>
                        <th>AKSI</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div id="modal-user" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-white">
                    <h5 class="modal-title font-weight-semibold title">Tambah Pengguna</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="user_id">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Nama Lengkap :</label>
                                <input type="text" id="user_fullname" placeholder="Ex. Muhammad Darmanto" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Nama Pengguna : </label>
                                <input type="text" id="user_name" placeholder="Ex. darmanto" class="form-control">
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
                                <input type="text" id="user_email" placeholder="Ex. darmato@gmail.com" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label>Tipe Pengguna : </label>
                                <select id="user_role" class="form-control select" data-placeholder="Pilih Tipe Pengguna">
                                    <option></option>
                                    <option value="1">Administrator</option>
                                    <option value="2">Keuangan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Diskripsi :</label>
                                <textarea id="user_desc" placeholder="Saya adalah orang yang tidak tahu & tidak mau tahu." class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="submit" value="store" class="btn btn-sm bg-primary btn-labeled btn-labeled-left"><b><i class="icon-floppy-disk"></i></b>SIMPAN</button>
                    <button type="button" class="btn btn-sm bg-danger btn-labeled btn-labeled-left" data-dismiss="modal"><b><i class="icon-close2"></i> </b>KELUAR</button>
                </div>
            </div>
        </div>
    </div>
@endsection
