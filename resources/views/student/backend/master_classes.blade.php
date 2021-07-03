@extends('student.layouts.master', ['title' => 'Master Data'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/student/backend/js/master_class.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Master Data</span>
    <span class="breadcrumb-item active">Data Kelas</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white header-elements-sm-inline">
                    <h5 class="card-title">DATA KELAS</h5>
                </div>
                <table class="table datatable-class table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Rombel</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-white header-elements-inline">
                            <h5 class="card-title title-add">TAMBAH DATA</h5>
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="class_id">
                            <div class="form-group">
                                <label>Tingkat</label>
                                <select id="class_level" data-placeholder="Pilih Tingkat" class="form-control select2">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jurusan</label>
                                <select id="class_major" data-placeholder="Pilih Jurusan" class="form-control select2">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Rombel</label>
                                <input type="text" id="class_name" class="form-control" placeholder="Ex. I, II, III">
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" id="class_alias" class="form-control" placeholder="Ex. X.IPA.1">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-info btn-labeled btn-labeled-left btn-sm" id="submit" value="store"><b><i class="icon-floppy-disk"></i></b> Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
