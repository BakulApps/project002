@extends('exam.layouts.master', ['title' => 'Master Data'])
@section('js')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/apps/exam/backend/js/class.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Data Master</span>
    <span class="breadcrumb-item active">Kelas</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">DATA KELAS</h6>
                </div>
                <table class="table datatable-class table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>TINGKAT</th>
                        <th>JURUSAN</th>
                        <th>ROMBEL</th>
                        <th>NAMA</th>
                        <th>WALIKELAS</th>
                        <th>AKSI</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold" id="form-title">TAMBAH KELAS</h6>
                </div>
                <div class="card-body">
                    <input type="hidden" id="class_id">
                    <div class="form-group">
                        <label>TINGKAT :</label>
                        <select id="class_level" data-placeholder="Pilih Tingkat" class="form-control select2">
                            <option></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>JURUSAN :</label>
                        <select id="class_major" data-placeholder="Pilih Jurusan" class="form-control select">
                            <option></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>KODE :</label>
                        <input type="text" id="class_code" class="form-control" placeholder="Ex. 1, 2, A, B">
                    </div>
                    <div class="form-group">
                        <label>NAMA :</label>
                        <input type="text" id="class_name" class="form-control" placeholder="Ex. VII.1, VII.2">
                    </div>
                    <div class="form-group">
                        <label>WALIKELAS :</label>
                        <select id="class_teacher" data-placeholder="Pilih Walikelas" class="form-control select">
                            <option></option>
                        </select>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left" id="submit" value="store"><b><i class="icon-floppy-disk"></i></b>SIMPAN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
