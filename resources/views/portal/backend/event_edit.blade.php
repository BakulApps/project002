@extends('portal.backend.layouts.master', ['title' => 'Acara & Kegiatan'])

@section('jsplugin')
    <link href="{{asset('assets/js/plugins/summernote/summernote-bs4.min.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('assets/js/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pickers/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/js/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/media/fancybox.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/styling/uniform.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/portal/backend/js/event_edit.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Acara & Kegiatan</span>
    <span class="breadcrumb-item active">Ubah</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-white header-elements-inline">
                            <h6 class="card-title font-weight-semibold">UBAH ACARA/KEGIATAN</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" class="form-control" id="event_title" value="{{$event->event_title}}">
                            </div>
                            <div id="event_content">{{$event->event_content}}</div>
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
                            <input type="hidden" id="event_id" value="{{$event->event_id}}">
                            <div class="form-group">
                                <label>Tanggal Mulai:</label>
                                <div class="input-group">
										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar22"></i></span>
										</span>
                                    <input type="text" id="event_date_start" class="form-control daterange-single" value="{{$event->date_start('d/m/Y')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Selsai:</label>
                                <div class="input-group">
										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar22"></i></span>
										</span>
                                    <input type="text" id="event_date_end" class="form-control daterange-single" value="{{$event->date_end('d/m/Y')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Lokasi:</label>
                                <div class="input-group">
										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-pin-alt"></i></span>
										</span>
                                    <input type="text" id="event_place" class="form-control" value="{{$event->event_place}}">
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="button" class="btn btn-sm bg-success" id="submit" value="update">SIMPAN</button>
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
                            <img class="img-fluid image-view" src="{{asset($event->event_image == null ? 'assets/portal/fronted/images/bg/blog-1.jpg' : 'storage/portal/fronted/images/event/'. $event->event_image)}}" width="" style="width: 100%">
                        </div>
                        <div class="card-body">
                            <input type="file" id="event_image" class="form-control-uniform" data-fouc>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')

@endsection
