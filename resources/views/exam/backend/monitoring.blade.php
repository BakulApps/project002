@extends('exam.layouts.master', ['title' => 'Monitoring Peserta'])
@section('js')
    <script src="{{asset('assets/js/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pickers/daterangepicker.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/apps/exam/backend/js/monitoring.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Jadwal Ujian</span>
    <span class="breadcrumb-item active">Monitoring Peserta</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <h6 class="card-title font-weight-semibold">MONITORING PESERTA</h6>
                </div>
                <table class="table datatable-schedule table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>NO PESERTA</th>
                        <th>NAMA SISWA</th>
                        <th>KELAS/th>
                        <th>STATUS</th>
                    </tr>
                    </thead>
                </table>
                <input type="hidden" id="class_id" value="{{$class_id}}">
                <input type="hidden" id="schedule_id" value="{{$schedule_id}}">
            </div>
        </div>
    </div>
@endsection
