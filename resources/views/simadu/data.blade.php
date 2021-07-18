@extends('simadu.layouts.master', ['title' => 'Data Siswa'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset("assets/apps/simadu/js/data.js")}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Data Siswa</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h5 class="card-title">DATA SISWA TAHUN PELAJARAN {{\App\Models\Master\Year::active('year_name')}}</h5>
                </div>
                <table class="table datatable-student table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>NAMA SISWA</th>
                        <th>NISN</th>
                        <th>NISM</th>
                        <th>KELAS</th>
                        <th>JENIS KELAMIN</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
