@extends('exam.layouts.master', ['title' => 'Jadwal'])
@section('js')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/apps/exam/fronted/js/schedule.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Jadwal Penilaian</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">JADWAL UJIAN</h6>
                </div>
                <table class="table datatable-schedule table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>MATA PELAJARAN</th>
                        <th>TANGGAL</th>
                        <th>MULAI</th>
                        <th>SELESAI</th>
                        <th>TOKEN</th>
                        <th>STATUS</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
