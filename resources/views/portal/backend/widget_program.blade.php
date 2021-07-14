@extends('portal.backend.layouts.master', ['title' => 'Widget'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/portal/backend/js/widget_program.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Halaman</span>
    <span class="breadcrumb-item active">Program</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">DATA PROGRAM</h6>
                    <div class="header-elements">
                        <button type="button" class="btn btn-primary btn-labeled btn-labeled-left font-weight-semibold" data-toggle="modal" data-target="#modal-program"><b><i class="icon-add"></i> </b>TAMBAH</button>
                    </div>
                </div>
                <table class="table datatable-program table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA PROGRAM</th>
                        <th>DISKRIPSI</th>
                        <th>GAMBAR</th>
                        <th>AKSI</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div id="modal-program" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-white">
                    <h5 class="modal-title font-weight-semibold title">Tambah Program</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="program_id">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Nama Program :</label>
                                <input type="text" id="program_name" placeholder="Tahfidz" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Diskripsi :</label>
                                <textarea id="program_desc" placeholder="Tulis Diskripsi program" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Tautan :</label>
                                <input type="text" id="program_link" placeholder="https://example.sch.id/artikel/3/baca" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Gambar Ikon : </label>
                                <input type="file" id="program_image" class="form-control-uniform-custom">
                            </div>
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
