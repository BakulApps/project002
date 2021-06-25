@extends('portal.backend.layouts.master', ['title' => 'Acara & Kegiatan'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/portal/backend/js/event_all.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Acara & Kegiatan</span>
    <span class="breadcrumb-item active">Semua</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">DATA ACARA & KEGIATAN</h6>
                    <div class="header-elements">
                        <button type="button" class="btn bg-info font-weight-semibold" id="button_add">TAMBAH</button>
                    </div>
                </div>
                <table class="table datatable-event table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>JUDUL</th>
                        <th>MULAI</th>
                        <th>SELESAI</th>
                        <th>AKSI</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
