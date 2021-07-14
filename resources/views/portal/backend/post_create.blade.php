@extends('portal.backend.layouts.master', ['title' => 'Postingan'])
@section('jsplugin')
    <link href="{{asset('assets/js/plugins/summernote/summernote-bs4.min.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/media/fancybox.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/styling/uniform.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/portal/backend/js/post_create.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Postingan</span>
    <span class="breadcrumb-item active">Tambah</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-white header-elements-inline">
                            <h6 class="card-title font-weight-semibold">TAMBAH POSTINGAN</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" class="form-control" id="post_title" placeholder="Judul Postingan">
                            </div>
                            <div id="post_content"></div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input-styled-primary" id="post_comment" value="1" data-fouc>
                                    Komentar
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-white header-elements-inline">
                            <h6 class="card-title font-weight-semibold" id="form-title">TERBITAN</h6>
                        </div>
                        <div class="card-body">
                            <p>Penulis : {{auth('portal')->user()->user_name}}</p>
                            <p>Visibilitas : Publik</p>
                            <p>Tanggal : {{\Carbon\Carbon::now()->translatedFormat('d F Y')}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-sm bg-info" id="save" value="save">SIMPAN</button>
                                <button type="button" class="btn btn-sm bg-success" id="publish" value="publish">TERBIT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-white header-elements-inline">
                            <h6 class="card-title font-weight-semibold" id="form-title">KATEGORI</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select data-placeholder="Pilih Kategori..." class="form-control select-category" id="post_category" data-fouc>
                                    <option></option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-sm bg-info" id="category-add">TAMBAH</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-white header-elements-inline">
                            <h6 class="card-title font-weight-semibold" id="form-title">TAGAR</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select data-placeholder="Pilih Tagar..." class="form-control select-tag" id="post_tag" multiple="multiple" data-fouc>
                                    <option></option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-sm bg-info" id="tag-add">TAMBAH</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-transparent header-elements-inline">
                            <h6 class="card-title font-weight-semibold">GAMBAR</h6>
                        </div>
                        <div class="card-img-actions">
                            <img class="img-fluid image-view" src="{{asset('assets/apps/portal/images/blog-1.jpg')}}" width="" style="width: 100%">
                        </div>
                        <div class="card-body">
                            <input type="file" id="post_image" class="form-control-uniform" data-fouc>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
