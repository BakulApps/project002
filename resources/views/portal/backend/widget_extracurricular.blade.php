@extends('portal.backend.layouts.master', ['title' => 'Widget'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/portal/backend/js/widget_extracurricular.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Widget</span>
    <span class="breadcrumb-item active">Ekstrakurikuler</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">DATA EKSTRAKURIKULER</h6>
                    <div class="header-elements">
                        <button type="button" class="btn btn-primary btn-labeled btn-labeled-left font-weight-semibold" data-toggle="modal" data-target="#modal-extracurricular"><b><i class="icon-add"></i> </b>TAMBAH</button>
                    </div>
                </div>
                <table class="table datatable-extracurricular table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA EKSTRAKURIKULER</th>
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
    <div id="modal-extracurricular" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-white">
                    <h5 class="modal-title font-weight-semibold title">Tambah Ekstrakurikuler</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="extracurricular_id">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Nama Ekstrakurikuler :</label>
                                <input type="text" id="extracurricular_name" placeholder="Ex. Bola Volly" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Diskripsi :</label>
                                <textarea id="extracurricular_desc" placeholder="Ex. Tulis Diskripsi Ekstrakurikuler" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Pelatih :</label>
                                <input type="text" id="extracurricular_teacher" placeholder="Ex. Agus Nugroho, S.Pd." class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label>Kategori :</label>
                                <input type="text" id="extracurricular_category" placeholder="Ex. Olahraga" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Hari :</label>
                                <input type="text" id="extracurricular_day" placeholder="Ex. Kamis" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label>Jam :</label>
                                <input type="text" id="extracurricular_time" placeholder="Ex. 14:00 WIB" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Rating :</label>
                                <input type="text" id="extracurricular_review" placeholder="Ex. 5" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label>Jumlah Peserta :</label>
                                <input type="text" id="extracurricular_student" placeholder="Ex. 20 Siswa" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Gambar : </label>
                                <input type="file" id="extracurricular_image" class="form-control-uniform-custom">
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
