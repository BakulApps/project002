@extends('exam.layouts.master', ['title' => 'Tambah Pengguna'])
@section('js')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/apps/exam/backend/js/user.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Pengguna</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">DATA PENGGUNA</h6>
                </div>
                <table class="table datatable-user table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA LENGKAP</th>
                        <th>HAK AKSES</th>
                        <th>NAMA PENGGUNA</th>
                        <th>AKSI</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold" id="form-title">TAMBAH PENGGUNA</h6>
                </div>
                <div class="card-body">
                    <input type="hidden" id="user_id">
                    <div class="form-group">
                        <label>NAMA LENGKAP :</label>
                        <input type="text" id="user_fullname" placeholder="Ex. WIKRAMAWARDHANA" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>NAMA PENGGUNA :</label>
                        <input type="text" id="user_name" placeholder="Ex. wikramawardhana" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>KATA SANDI :</label>
                        <input type="password" id="user_pass" placeholder="Ex. 000099999" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>HAK AKSES :</label>
                        <select id="user_role" data-placeholder="Pilih Akses" class="form-control select2">
                            <option></option>
                        </select>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left" id="submit" value="store"><b><i class="icon-floppy-disk"></i></b>SIMPAN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
