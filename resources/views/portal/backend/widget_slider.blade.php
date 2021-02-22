@extends('portal.backend.layouts.master')
@section('js')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/portal/backend/js/widget_slider.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Halaman</span>
    <span class="breadcrumb-item active">Slider</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">DATA SLIDER</h6>
                    <div class="header-elements">
                        <button type="button" class="btn btn-primary btn-labeled btn-labeled-left font-weight-semibold" data-toggle="modal" data-target="#modal-slider"><b><i class="icon-file-video"></i> </b>TAMBAH</button>
                    </div>
                </div>
                <table class="table datatable-slider table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>JUDUL</th>
                        <th>DISKRIPSI</th>
                        <th>GAMBAR</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div id="modal-slider" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-white">
                    <h5 class="modal-title font-weight-semibold title">Tambah Slider</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="slider_id">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Judul :</label>
                                <input type="text" id="slider_title" placeholder="Ex. PPDB Online TP 2021/2022" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Diskripsi :</label>
                                <textarea id="slider_content" placeholder="Saya adalah orang yang tidak tahu & tidak mau tahu." class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Tautan : </label>
                                <input type="text" id="slider_button_link_1" placeholder="Ex. https://example.com/article/1/read" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label>Tombol :</label>
                                <input type="text" id="slider_button_name_1" placeholder="Ex. Daftar Sekarang" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Tautan : </label>
                                <input type="text" id="slider_button_link_2" placeholder="Ex. https://example.com/article/10/read" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label>Tombol :</label>
                                <input type="text" id="slider_button_name_2" placeholder="Ex. Selengkapnya" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Status : </label>
                                <select data-placeholder="Pilih Status..." class="form-control select" id="slider_status" data-fouc>
                                    <option></option>
                                    <option value="0">Tidak Aktif</option>
                                    <option value="1">Aktif</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Gambar Latar : </label>
                                <input type="file" id="slider_image" class="form-control-uniform-custom">
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
