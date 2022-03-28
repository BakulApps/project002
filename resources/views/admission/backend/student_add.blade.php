@extends('admission.backend.layouts.master', ['title' => 'Data Siswa'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pickers/daterangepicker.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/admission/backend/js/student_add.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Siswa</span>
    <span class="breadcrumb-item active">Tambah Siswa</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white header-elements-sm-inline">
                    <h5 class="card-title font-weight-semibold">TAMBAH SISWA</h5>
                </div>
                <div class="card-body">
                    @include('admission.backend.componens.form_student')
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">STATUS PENDAFTARAN</h6>
                </div>
                <div class="card-body">
                    @if($compelete == false)
                        <h4 class="text-danger text-center font-weight-semibold">DATA BELUM LENGKAP</h4>
                        <p class="text-justify">Masih terdapat beberapa datang yang belum dilengkapi, silahkan melengkapi terlebih dahulu sebelum mencetak formulir pendaftaran.</p>
                    @else
                        <h4 class="text-success text-center font-weight-semibold">DATA LENGKAP</h4>
                        <p class="text-center">Data sudah lengkap, formulir siap di cetak.</p>
                    @endif
                    <div class="mt-3">
                        <button type="submit" class="btn bg-success btn-labeled btn-labeled-left col-md-12" id="print" @if($compelete == false) disabled @endif><b><i class="icon-printer"></i></b> CETAK FORMULIR</button>
                    </div>
                </div>
                <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn bg-info btn-labeled btn-labeled-left" id="store"><b><i class="icon-floppy-disk"></i></b> SIMPAN</button>
                    <a type="submit" class="btn bg-danger btn-labeled btn-labeled-left" id="auth"><b><i class="icon-switch"></i></b> KELUAR</a>
                </div>
            </div>
        </div>
    </div>
@endsection
