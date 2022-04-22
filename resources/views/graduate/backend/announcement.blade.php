@extends('graduate.layouts.master', ['title' => 'Pengumuman'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/graduate/backend/js/announcement.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Kelulusan</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h5 class="card-title">DATA KELULUSAN SISWA</h5>
                    <div class="header-elements">
                        <button type="button" id="btn-sync" class="btn btn-danger btn-labeled btn-labeled-left"><b><i class="icon-sync"></i></b>SINKRON NILAI</button>
                    </div>
                </div>
                <table class="table datatable-notify table-bordered">
                    <thead>
                    <tr>
                        <th>UUID</th>
                        <th>Nomor Surat</th>
                        <th>Nama Siswa</th>
                        <th>Total Nilai</th>
                        <th>Status</th>
                        <th>Dilihat</th>
                        <th>Dicetak</th>
                        <th>Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div id="modal-edit" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">UBAH DATA KELULUSAN</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="announcement_id">
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" id="announcement_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">NISM</label>
                        <div class="col-sm-9">
                            <input type="text" id="announcement_nism" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">NISN</label>
                        <div class="col-sm-9">
                            <input type="text" id="announcement_nisn" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Status Kelulusan</label>
                        <div class="col-sm-9">
                            <select id="announcement_status" class="form-control select">
                                <option value="1">LULUS</option>
                                <option value="2">TIDAK LULUS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Status Pembayaran</label>
                        <div class="col-sm-9">
                            <select id="announcement_finance" class="form-control select">
                                <option value="1">LUNAS</option>
                                <option value="2">BELUM LUNAS</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="submit" class="btn bg-primary">SIMPAN</button>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-show" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">DATA KELULUSAN</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Nama Lengkap</label>
                        <input type="text" id="student_name" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Nomor Induk Siswa Madrasah</label>
                                <input type="text" id="student_nism" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Nomor Induk Siswa Nasional</label>
                                <input type="text" id="student_nisn" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td class="font-weight-bold text-center">NO</td>
                                <td class="font-weight-bold text-center">MATA PELAJARAN</td>
                                <td class="font-weight-bold text-center">NILAI UJIAN</td>
                            </tr>
                            @php($no = 1)
                            @foreach(\App\Models\Master\Subject::OrderBy('subject_number')->get() as $subject)
                                <tr>
                                    <td class="text-center">{{$no++}}</td>
                                    <td>{{$subject->subject_name}}</td>
                                    <td id="value{{$subject->subject_id}}" class="text-center"></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
