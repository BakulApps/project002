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
                    <div class="header-elements">
                        <button type="button" class="btn btn-primary btn-labeled btn-labeled-left font-weight-semibold" data-toggle="modal" data-target="#modal-schedule"><b><i class="icon-calendar2"></i> </b>TAMBAH</button>
                    </div>
                </div>
                <table class="table datatable-schedule table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>MATA PELAJARAN</th>
                        <th>TINGKAT</th>
                        <th>JURUSAN</th>
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
    </div>
@endsection
@section('modal')
    <div id="modal-schedule" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-white">
                    <h5 class="modal-title font-weight-semibold title">Tambah Jadwal</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="schedule_id">
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
                        <div class="form-group col-md-12">
                            <label>MATA PELAJARAN :</label>
                            <select id="schedule_subject" data-placeholder="Pilih Pelajaran" class="form-control select2">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>TINGKAT :</label>
                            <select id="schedule_level" data-placeholder="Pilih Tingkat" class="form-control select2">
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>JURUSAN :</label>
                            <select id="schedule_major" data-placeholder="Pilih Jurusan" class="form-control select2">
                                <option></option>
                            </select>
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
                </div>
                <div class="modal-footer">
                    <button type="button" id="submit" value="store" class="btn btn-sm bg-primary btn-labeled btn-labeled-left"><b><i class="icon-floppy-disk"></i></b>SIMPAN</button>
                    <button type="button" class="btn btn-sm bg-danger btn-labeled btn-labeled-left" data-dismiss="modal"><b><i class="icon-close2"></i> </b>KELUAR</button>
                </div>
            </div>
        </div>
    </div>
@endsection
