@extends('portal.backend.layouts.master')

@section('js')
    <link href="{{asset('assets/js/plugins/summernote/summernote-bs4.min.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/media/fancybox.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/styling/uniform.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/portal/backend/js/comment_detail.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Komentar</span>
    <span class="breadcrumb-item active">{{$comment->post[0]->post_title}}</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    <div class="col-md-12">
                        <div class="flex-fill overflow-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media flex-column flex-md-row">
                                        <a href="#" class="d-none d-md-block mr-md-3 mb-3 mb-md-0">
                                            <span class="btn bg-teal-400 btn-icon btn-lg rounded-round">
                                                <i class="icon-comment"></i>
                                            </span>
                                        </a>
                                        <div class="media-body">
                                            <h6 class="mb-0">{{$comment->post[0]->post_title}}</h6>
                                            <div class="letter-icon-title font-weight-semibold">{{$comment->comment_name}} <a href="#">&lt;{{$comment->comment_email}}&gt;</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p style="text-align: justify">{{$comment->comment_content}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($parent != null)
                    <div class="col-md-10 offset-2">
                        <div class="flex-fill overflow-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media flex-column flex-md-row">
                                        <a href="#" class="d-none d-md-block mr-md-3 mb-3 mb-md-0">
                                            <span class="btn bg-teal-400 btn-icon btn-lg rounded-round">
                                                <i class="icon-comment"></i>
                                            </span>
                                        </a>
                                        <div class="media-body">
                                            <h6 class="mb-0">{{$comment->post[0]->post_title}}</h6>
                                            <div class="letter-icon-title font-weight-semibold">{{$parent[0]->comment_name}} <a href="#">&lt;{{$parent[0]->comment_email}}&gt;</a></div>
                                        </div>
                                        <div class="align-self-md-center ml-md-3 mt-3 mt-md-0">
                                            <ul class="list-inline list-inline-condensed mb-0">
                                                <li class="list-inline-item">
                                                    <button class="btn btn-sm bg-transparent border-slate-300 text-slate rounded-round" id="btn-edit" value="{{$parent[0]->comment_id}}"><i class="icon-pencil"></i></button>
                                                    <button class="btn btn-sm bg-transparent border-slate-300 text-slate rounded-round" id="btn-delete" value="{{$parent[0]->comment_id}}"><i class="icon-trash"></i></button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p style="text-align: justify">{{$parent[0]->comment_content}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-white header-elements-inline">
                            <h6 class="card-title font-weight-semibold">BALAS KOMENTAR</h6>
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="comment_id" value="{{$comment->comment_id}}">
                            <input type="hidden" id="comment_parent" value="{{$comment->comment_id}}">
                            <input type="hidden" id="comment_name" value="{{auth('portal')->user()->user_name}}">
                            <div class="form-group">
                                <textarea class="form-control" id="comment_content" rows="9"></textarea>
                            </div>
                            <button type="submit" class="btn btn-info btn-sm" id="submit" value="store">SIMPAN</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
