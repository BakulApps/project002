@extends('portal.fronted.layouts.master', ['page' => $extracurricular->extracurricular_name])
@section('content')
    <section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8" style="background-image: url({{$section->value('article_section_title_bg')}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Ekstrakurikuler</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                                <li class="breadcrumb-item" aria-current="page">Ekstrakurikuler</li>
                                <li class="breadcrumb-item active" aria-current="page">{{$extracurricular->extracurricular_name}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="corses-singel" class="pt-90 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="corses-singel-left mt-30">
                        <div class="title">
                            <h3>{{$extracurricular->extracurricular_name}}</h3>
                        </div>
                        <div class="course-terms">
                            <ul>
                                <li>
                                    <div class="teacher-name">
                                        <div class="thum">
                                            <img src="{{asset('assets/apps/portal/images/placeholder.jpg')}}" alt="Teacher" style="width: 50px">
                                        </div>
                                        <div class="name">
                                            <span>Pelatih</span>
                                            <h6>{{$extracurricular->extracurricular_teacher}}</h6>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="course-category">
                                        <span>Kategori</span>
                                        <h6>{{$extracurricular->extracurricular_category}} </h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="review">
                                        <span>Rating</span>
                                        <ul>
                                            @for($i=0;$i<$extracurricular->extracurricular_review;$i++)
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                            @endfor
                                            <li class="rating">({{$extracurricular->extracurricular_review}} Rating)</li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="corses-singel-image pt-50">
                            <img src="{{asset('storage/portal/images/extracurricular/'. $extracurricular->extracurricular_image)}}" alt="Courses">
                        </div>

                        <div class="corses-tab mt-30">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                    <div class="overview-description">
                                        <div class="singel-description pt-40">
                                            <h6>Diskripsi</h6>
                                            <p>{{$extracurricular->extracurricular_desc}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12 col-md-6">
                            <div class="course-features mt-30">
                                <h4>Keterangan </h4>
                                <ul>
                                    <li><i class="fa fa-calendar"></i>Hari : <span>{{$extracurricular->extracurricular_day}}</span></li>
                                    <li><i class="fa fa-clock-o"></i>Waktu : <span>{{$extracurricular->extracurricular_time}}</span></li>
                                    <li><i class="fa fa-user-o"></i>Peserta :  <span>{{$extracurricular->extracurricular_student}}</span></li>
                                </ul>
                                <div class="price-button pt-10">
                                    <a href="#" class="main-btn">Daftar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
