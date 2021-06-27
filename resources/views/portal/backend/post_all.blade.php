@extends('portal.backend.layouts.master', ['title' => 'Postingan'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/portal/backend/js/post_all.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Postingan</span>
    <span class="breadcrumb-item active">Semua</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">DATA POSTINGAN</h6>
                    <div class="header-elements">
                        <button type="button" class="btn bg-info font-weight-semibold" id="button_add">TAMBAH</button>
                    </div>
                </div>
                <table class="table datatable-post table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>JUDUL</th>
                        <th>PEMBUAT</th>
                        <th>TANGGAL</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
