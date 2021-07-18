@extends('portal.fronted.layouts.master', ['page' => 'PROFIL MADRASAH', 'title' => $teacher->teacher_name])
@section('content')
    <section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8" style="background-image: url({{$section->value('article_section_title_bg')}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Profil Madrasah</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Profil Madrasah</a></li>
                                <li class="breadcrumb-item" aria-current="page">Pendidik & Tenaga Kependidikan</li>
                                <li class="breadcrumb-item active" aria-current="page">{{$teacher->teacher_name}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="teachers-singel" class="pt-70 pb-120 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-8">
                    <div class="teachers-left mt-50">
                        <div class="hero">
                            <img src="{{asset($teacher->teacher_image == null ? 'assets/apps/portal/images/blog-1.jpg' : 'storage/portal/images/teacher/'. $teacher->teacher_image)}}" alt="Teachers">
                        </div>
                        <div class="name">
                            <h6>{{$teacher->teacher_name}}</h6>
                            <span>{{$teacher->teacher_job}}</span>
                        </div>
                        <div class="social">
                            <ul>
                                <li><a href="#"><i class="fa fa-envelope-square"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
                            </ul>
                        </div>
                        <div class="description">
                            <p>{{$teacher->teacher_desc}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="teachers-right mt-50">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                <div class="dashboard-cont">
                                    <div class="singel-dashboard pt-40">
                                        <h5>Tentang</h5>
                                        <p>{{$teacher->teacher_about}}</p>
                                    </div>
                                    <div class="singel-dashboard pt-40">
                                        <h5>Penghargaan</h5>
                                        <p>{{$teacher->teacher_achievement}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
