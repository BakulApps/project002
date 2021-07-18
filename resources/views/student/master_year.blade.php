@extends('student.layouts.master', ['title' => 'Master Data'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/student/js/master_year.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Master Data</span>
    <span class="breadcrumb-item active">Tahun Pelajaran</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white header-elements-sm-inline">
                    <h5 class="card-title">TAHUN PELAJARAN</h5>
                </div>
                <table class="table datatable-year table-bordered">
                    <thead>
                    <tr>
                        <th>Urutan</th>
                        <th>Nama</th>
                        <th>Diskripsi</th>
                        <th>Status</th>
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
                            <input type="hidden" id="year_id">
                            <div class="form-group">
                                <label>Nomer Urut</label>
                                <input type="text" id="year_number" class="form-control" placeholder="Ex. 1">
                            </div>
                            <div class="form-group">
                                <label>Nama Tahun</label>
                                <input type="text" id="year_name" class="form-control" placeholder="Ex. 2019/2020">
                            </div>
                            <div class="form-group">
                                <label>Diskripsi Tahun</label>
                                <textarea id="year_desc" class="form-control" placeholder="Ex. TP. 2019/2020"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select id="year_active" class="form-control select" data-fouc>
                                    <option value="1">Aktif</option>
                                    <option value="2">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-info btn-labeled btn-labeled-left btn-sm" id="submit" value="store"><b><i class="icon-floppy-disk"></i></b> Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-white header-elements-inline">
                            <h5 class="card-title title-add">SEMESTER AKTIF</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select id="year_active" class="form-control select" data-fouc>
                                    <option value="1">Semester Gasal</option>
                                    <option value="2">Semester Genap</option>
                                </select>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-info btn-labeled btn-labeled-left btn-sm" id="semester" value="update"><b><i class="icon-floppy-disk"></i></b> Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
