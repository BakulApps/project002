@extends('portal.backend.layouts.master')
@section('js')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/portal/backend/js/comment_all.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Komentar</span>
    <span class="breadcrumb-item active">Semua</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">DATA KOMENTAR</h6>
                </div>
                <table class="table datatable-comment table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>JUDUL</th>
                        <th>NAMA</th>
                        <th>EMAIL</th>
                        <th>AKSI</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
