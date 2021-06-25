@extends('portal.backend.layouts.master')
@section('js')
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/apps/portal/backend/js/page_home.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Halaman</span>
    <span class="breadcrumb-item active">Beranda</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold" id="form-title">Tentang Kami</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Section :</label>
                        <input type="text" id="home_section_about_name" class="form-control" value="{{$section->value('home_section_about_name')}}">
                    </div>
                    <div class="form-group">
                        <label>Judul Section :</label>
                        <input type="text" id="home_section_about_title" class="form-control" value="{{$section->value('home_section_about_title')}}">
                    </div>
                    <div class="form-group">
                        <label>Diskripsi :</label>
                        <textarea class="form-control" id="home_section_about_content" rows="4">{{$section->value('home_section_about_content')}}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tautan :</label>
                                <input type="text" id="home_section_about_link" class="form-control" value="{{$section->value('home_section_about_link')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tombol :</label>
                                <input type="text" id="home_section_about_button" class="form-control" value="{{$section->value('home_section_about_button')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Gambar Latar : </label>
                        <input type="file" id="home_section_about_image" class="form-control-uniform-custom">
                        <span class="text-muted">Ukuran Gambar 922 x 731 px</span>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left" id="about" value="about"><b><i class="icon-floppy-disk"></i></b>SIMPAN</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold" id="form-title">Youtube</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Link Youtube :</label>
                        <input type="text" id="home_section_yt_youtube" class="form-control" value="{{$section->value('home_section_yt_youtube')}}">
                    </div>
                    <div class="form-group">
                        <label>Gambar Latar : </label>
                        <input type="file" id="home_section_yt_background" class="form-control-uniform-custom">
                        <span class="text-muted">Ukuran Gambar 922 x 731 px</span>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left" id="youtube" value="youtube"><b><i class="icon-floppy-disk"></i></b>SIMPAN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold" id="form-title">Mengapa Harus Kami?</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Judul-1 :</label>
                                <input type="text" id="home_section_4_title_1" class="form-control" value="{{$section->value('home_section_4_title_1')}}">
                            </div>
                            <div class="form-group">
                                <label>Konten-1 :</label>
                                <textarea id="home_section_4_content_1" class="form-control">{{$section->value('home_section_4_content_1')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Gambar Ikon-1 : </label>
                                <input type="file" id="home_section_4_icon_1" class="form-control-uniform-custom">
                                <span class="text-muted">Ukuran Gambar 922 x 731 px</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Judul-2 :</label>
                                <input type="text" id="home_section_4_title_2" class="form-control" value="{{$section->value('home_section_4_title_2')}}">
                            </div>
                            <div class="form-group">
                                <label>Konten-2 :</label>
                                <textarea id="home_section_4_content_2" class="form-control">{{$section->value('home_section_4_content_2')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Gambar Ikon-2 : </label>
                                <input type="file" id="home_section_4_icon_2" class="form-control-uniform-custom">
                                <span class="text-muted">Ukuran Gambar 922 x 731 px</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Judul-3 :</label>
                                <input type="text" id="home_section_4_title_3" class="form-control" value="{{$section->value('home_section_4_title_3')}}">
                            </div>
                            <div class="form-group">
                                <label>Konten-3 :</label>
                                <textarea id="home_section_4_content_3" class="form-control">{{$section->value('home_section_4_content_3')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Gambar Ikon-3 : </label>
                                <input type="file" id="home_section_4_icon_3" class="form-control-uniform-custom">
                                <span class="text-muted">Ukuran Gambar 922 x 731 px</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left" id="section-4" value="section-4"><b><i class="icon-floppy-disk"></i></b>SIMPAN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
