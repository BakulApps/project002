@extends('admission.backend.layouts.master', ['title' => 'Data Siswa'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/admission/backend/js/student.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Data Siswa</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-sm-inline">
                    <h5 class="card-title font-weight-semibold">DATA SISWA</h5>
                    <div class="header-elements">
                        <a href="{{route('admission.admin.studentadd')}}" class="btn bg-blue"><i class="icon-user mr-2"></i> Tambah</a>
                    </div>
                </div>
                <table class="table datatable-student table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>NIK</th>
                        <th>TTL</th>
                        <th>Alamat</th>
                        <th>Nama Wali</th>
                        <th>Pendaftaran</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
