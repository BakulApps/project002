@extends('admission.fronted.layouts.master', ['title' => 'Rekap Penaftaran'])
@section('js')
    <script src="{{asset('assets/js/plugins/d3/d3.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/c3/c3.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/apps/admission/fronted/js/result.js')}}"></script>
@endsection
@section('breadcrumb')
    <a href="#" class="breadcrumb-item active">Rekap Pendaftaran</a>
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-white header-elements-sm-inline">
            <h6 class="card-title font-weight-semibold">STATISTIK PENDAFTAR</h6>
            <div class="header-elements">
                <select class="form-control select2" id="data" data-fouc>
                    <option value="1">Jumlah Pendaftar</option>
                    <option value="2">Jenis Kelamin</option>
                    <option value="3">Program Pilihan</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <div class="chart" id="result_admission"></div>
            </div>
        </div>
    </div>
@endsection
