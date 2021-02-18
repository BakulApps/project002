@extends('portal.fronted.layouts.master')
@section('content')
    <section id="page-banner" class="pt-105 pb-130 bg_cover" data-overlay="8" style="background-image: url({{$section->value('article_section_title_bg')}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Artikel</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Artikel</li>
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
                    @foreach($posts as $post)
                    <div class="singel-blog mt-30">
                        <div class="blog-cont">
                            <a href="{{route('potral.article.read', $post->post_id)}}"><h3>{{$post->post_title}}</h3></a>
                            <ul>
                                <li><a href="#"><i class="fa fa-calendar"></i>{{$post->created_at()}}</a></li>
                                <li><a href="#"><i class="fa fa-user"></i>{{$post->user->user_name}}</a></li>
                                <li><a href="#"><i class="fa fa-tags"></i>{{$post->category->category_name}}</a></li>
                            </ul>
                            <p style="text-align: justify">{{Str::limit($post->post_content, 250)}}</p>
                        </div>
                    </div>
                    @endforeach
                    @if($posts->lastPage() > 1)
                    <nav class="courses-pagination mt-50">
                        <ul class="pagination justify-content-lg-end justify-content-center">
                            <li class="page-item">
                                <a href="{{$posts->currentPage() == 1 ? '#' : $posts->previousPageUrl()}}" aria-label="Previous"><i class="fa fa-angle-left"></i></a>
                            </li>
                            @for($i=1;$i <= $posts->lastPage(); $i++)
                            <li class="page-item"><a class="{{$posts->currentPage() == $i ? 'active' : null}}" href="{{$posts->url($i)}}">{{$i}}</a></li>
                            @endfor
                            <li class="page-item">
                                <a href="{{$posts->currentPage() == $posts->lastPage() ? '#' :$posts->nextPageUrl()}}" aria-label="Next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    @endif
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
                                            <a href="{{route('potral.article.read', $popular->post_id)}}">
                                                <div class="singel-post">
                                                    <div class="thum">
                                                        <img src="{{asset($popular->post_image)}}" alt="Blog" style="height: 92px">
                                                    </div>
                                                    <div class="cont">
                                                        <h6>{{$popular->post_title}}</h6>
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
