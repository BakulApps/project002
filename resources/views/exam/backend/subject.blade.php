@extends('exam.layouts.master', ['title' => 'Master Data'])
@section('js')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/apps/exam/backend/js/subject.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Data Master</span>
    <span class="breadcrumb-item active">Mata Pelajaran</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">DATA MATA PELAJARAN</h6>
                </div>
                <table class="table datatable-subject table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>KODE</th>
                        <th>NAMA</th>
                        <th>AKSI</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold" id="form-title">TAMBAH PELAJARAN</h6>
                </div>
                <div class="card-body">
                    <input type="hidden" id="subject_id">
                    <div class="form-group">
                        <label>KODE :</label>
                        <input type="text" id="subject_code" class="form-control" placeholder="Ex. BIN">
                    </div>

                    <div class="form-group">
                        <label>NAMA :</label>
                        <input type="text" id="subject_name" class="form-control" placeholder="Ex. Bahasa Indonesia">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left" id="submit" value="store"><b><i class="icon-floppy-disk"></i></b>SIMPAN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
