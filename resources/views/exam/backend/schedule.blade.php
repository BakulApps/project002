@extends('exam.layouts.master', ['title' => 'Jadwal Penilaian'])
@section('js')
    <script src="{{asset('assets/js/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pickers/daterangepicker.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/apps/exam/backend/js/schedule.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Jadwal Penilaian</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">JADWAL PENILAIAN</h6>
                </div>
                <table class="table datatable-schedule table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>MATA PELAJARAN</th>
                        <th>TINGKAT</th>
                        <th>TANGGAL</th>
                        <th>MULAI</th>
                        <th>SELESAI</th>
                        <th>TOKEN</th>
                        <th>AKSI</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold" id="form-title">TAMBAH JADWAL</h6>
                </div>
                <div class="card-body">
                    <input type="hidden" id="schedule_id">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>MATA PELAJARAN :</label>
                            <select id="schedule_subject" data-placeholder="Pilih Pelajaran" class="form-control select2">
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>TINGKAT :</label>
                            <select id="schedule_level" data-placeholder="Pilih Tingkat" class="form-control select2">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>MULAI :</label>
                            <input type="text" id="schedule_start" class="form-control daterange">
                        </div>
                        <div class="form-group col-md-4">
                            <label>SELESAI :</label>
                            <input type="text" id="schedule_end" class="form-control daterange">
                        </div>
                        <div class="form-group col-md-4">
                            <label>TOKEN :</label>
                            <input type="text" id="schedule_token" class="form-control" placeholder="Ex. PANDAI">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>LINK :</label>
                            <input type="text" id="schedule_link" class="form-control" placeholder="Ex. https://shorturl.at/abcde">
                        </div>
                        <div class="form-group col-md-6">
                            <label>MONITORING :</label>
                            <input type="text" id="schedule_monitoring" class="form-control" placeholder="Ex. https://shorturl.at/abcde">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left" id="submit" value="store"><b><i class="icon-floppy-disk"></i></b>SIMPAN</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">

        </div>
    </div>
@endsection
