@extends('portal.backend.layouts.master', ['title' => 'Postingan'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/portal/backend/js/post_category.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Postingan</span>
    <span class="breadcrumb-item active">Kategori</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">DATA KATEGORI</h6>
                </div>
                <table class="table datatable-category table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>KATEGORI</th>
                        <th>DISKRIPSI</th>
                        <th>AKSI</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold" id="form-title">TAMBAH KATEGORI</h6>
                </div>
                <div class="card-body">
                    <input type="hidden" id="category_id">
                    <div class="form-group">
                        <label>Kategori :</label>
                        <input type="text" id="category_name" class="form-control" placeholder="Ex. Berita, Kategori">
                    </div>

                    <div class="form-group">
                        <label>Diskripsi :</label>
                        <textarea class="form-control" id="category_desc" placeholder="Ex. Kategori Berita, Kategori Artikel" rows="4"></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left" id="submit" value="store"><b><i class="icon-floppy-disk"></i></b>SIMPAN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
