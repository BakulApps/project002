@extends('portal.fronted.layouts.master', ['title' => $post->post_title])
@section('content')
    <section id="page-banner" class="pt-105 pb-130 bg_cover" data-overlay="8" style="background-image: url({{asset($post->image == null ?'assets/apps/portal/images/blog-1.jpg' : 'storage/portal/images/post/'. $post->post_image)}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>{{$post->post_title}}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('portal.home')}}">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="{{route('portal.article')}}">Artikel</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$post->post_title}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="blog-page" class="pt-90 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details mt-30">
                        <div class="thum">
                            <img src="{{asset($post->image == null ?'assets/apps/portal/images/blog-1.jpg' : 'storage/portal/images/post/'. $post->post_image)}}" alt="Blog Details" style="width: 772px">
                        </div>
                        <div class="cont">
                            <h3>{{$post->post_title}}</h3>
                            <ul>
                                <li><a href="#"><i class="fa fa-calendar"></i>{{$post->created_at()}}</a></li>
                                <li><a href="#"><i class="fa fa-user"></i>{{$post->user->user_name}}</a></li>
                                <li><a href="#"><i class="fa fa-tags"></i>{{$post->category->category_name}}</a></li>
                            </ul>
                            <p style="text-align: justify">{!! $post->post_content !!}</p>
                            <ul class="share">
                                <li class="title">Share :</li>
                                <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                            </ul>
                            @if($post->post_comment == 1)
                            <div class="blog-comment pt-45">
                                <div class="title pb-15">
                                    <h3>Komentar</h3>
                                </div>
                                <ul>
                                    @foreach($post->comment as $comment)
                                    <li>
                                        <div class="comment">
                                            <div class="comment-author">
                                                <div class="author-thum">
                                                    <img src="{{asset('assets/apps/portal/fronted/images/bg/blog-1.jpg')}}" alt="Reviews">
                                                </div>
                                                <div class="comment-name">
                                                    <h6>{{$comment->comment_name}}</h6>
                                                    <span>{{$comment->created_at()}}</span>
                                                </div>
                                            </div>
                                            <div class="comment-description pt-20">
                                                <p style="text-align: justify">{{$comment->comment_content}}</p>
                                            </div>
                                        </div>
                                        @if(\App\Models\Portal\Comment::parent($comment->comment_id)->count() > 0)
                                        @php
                                        $parent = \App\Models\Portal\Comment::parent($comment->comment_id)->get()
                                        @endphp
                                        <ul class="replay">
                                            <li>
                                                <div class="comment">
                                                    <div class="comment-author">
                                                        <div class="author-thum">
                                                            <img src="{{asset('assets/apps/portal/fronted/images/bg/blog-1.jpg')}}" alt="Reviews">
                                                        </div>
                                                        <div class="comment-name">
                                                            <h6>{{$parent->comment_name}}</h6>
                                                            <span>{{$parent->created_at()}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="comment-description pt-20">
                                                        <p style="text-align: justify">{{$parent->comment_content}}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="title pt-45 pb-25">
                                    <h3>Tinggalkan Komentar</h3>
                                </div>
                                <div class="comment-form">
                                    <form action="{{route('portal.article.read', $post->post_id)}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-singel">
                                                    <input type="text" name="comment_name" placeholder="Nama Lengkap">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-singel">
                                                    <input type="email" name="comment_email" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-singel">
                                                    <textarea name="comment_content" placeholder="Komentar"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-singel">
                                                    <button class="main-btn">Kirim</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="saidbar">
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="saidbar-search mt-30">
                                    <form action="#">
                                        <input type="text" placeholder="Pencarian">
                                        <button type="button"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                                <div class="categories mt-30">
                                    <h4>Kategori</h4>
                                    <ul>
                                        @foreach($categories as $category)
                                            <li><a href="{{route('portal.category', $category->category_id)}}">{{$category->category_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="saidbar-post mt-30">
                                    <h4>Artikel Terpoluler</h4>
                                    <ul>
                                        @foreach($populars as $popular)
                                            <li>
                                                <a href="{{route('portal.article.read', $popular->post_id)}}">
                                                    <div class="singel-post">
                                                        <div class="thum">
                                                            <img src="{{asset('assets/apps/portal/images/blog-1.jpg')}}" alt="Blog" style="height: 92px">
                                                        </div>
                                                        <div class="cont">
                                                            <p>{{$popular->post_title}}</p>
                                                            <span>{{$popular->created_at()}}</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
