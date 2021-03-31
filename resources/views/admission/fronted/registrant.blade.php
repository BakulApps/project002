@extends('admission.fronted.layouts.master', ['title' => 'Pendaftar'])
@section('js')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/apps/admission/fronted/js/registrant.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item action">Pendaftar</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">DATA PENDAFTAR</h6>
                </div>
                <table class="table datatable-post table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>NIK</th>
                        <th>NISN</th>
                        <th>ALAMAT</th>
                        <th>NAMA AYAH</th>
                        <th>NAMA IBU</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
