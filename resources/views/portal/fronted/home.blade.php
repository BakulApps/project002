@extends('portal.fronted.layouts.master')
@section('content')
    @if($sliders->count() >= 1)
    <section id="slider-part" class="slider-active">
        @foreach($sliders as $slider)
        <div class="single-slider bg_cover pt-150" style="background-image: url({{asset('storage/portal/fronted/images/slider/'. $slider->slider_image)}})" data-overlay="4">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-9">
                        <div class="slider-cont">
                            <h1 data-animation="bounceInLeft" data-delay="1s">{{$slider->slider_title}}</h1>
                            <p data-animation="fadeInUp" data-delay="1.3s">{{$slider->slider_content}}</p>
                            <ul>
                                <li><a data-animation="fadeInUp" data-delay="1.6s" class="main-btn" href="{{$slider->slider_button_link_1}}">{{$slider->slider_button_name_1}}</a></li>
                                @if($slider->slider_button_link_2 != null)<li><a data-animation="fadeInUp" data-delay="1.9s" class="main-btn main-btn-2" href="{{$slider->slider_button_link_2}}">{{$slider->slider_button_name_2}}</a></li>@endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </section>
    @endif
    @if($section->value('home_section_program') == 1)
    <section id="category-part">
        <div class="container">
            <div class="category pt-40 pb-80">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="category-text pt-40">
                            <h2>PROGRAM UNGGULAN</h2>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-lg-1 col-md-8 offset-md-2 col-sm-8 offset-sm-2 col-8 offset-2">
                        <div class="row category-slied mt-40">
                            @php($no = 1)
                            @foreach($programs as $program)
                            <div class="col-lg-4">
                                <a href="{{$program->program_link}}">
                                    <span class="singel-category text-center color-2">
                                        <span class="icon">
                                            <img src="{{asset('storage/portal/fronted/images/program/'. $program->program_image)}}" alt="Icon">
                                        </span>
                                        <span class="cont">
                                            <span>{{$program->program_name}}</span>
                                        </span>
                                    </span>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <section id="about-part" class="pt-65">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title mt-50">
                        <h5>{{$section->value('home_section_about_name')}}</h5>
                        <h2>{{$section->value('home_section_about_title')}}</h2>
                    </div>
                    <div class="about-cont">
                        <p>{{$section->value('home_section_about_content')}}</p>
                        <a href="{{$section->value('home_section_about_link')}}" class="main-btn mt-55">{{$section->value('home_section_about_button')}}</a>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="about-event mt-50">
                        <div class="event-title">
                            <h3>Acara Mendatang</h3>
                        </div>
                        @if($events->count() >= 3)
                        <ul>
                            @foreach($events as $event)
                            <li>
                                <div class="singel-event">
                                    <span><i class="fa fa-calendar"></i> {{$event->date_start() .' - '. $event->date_end()}}</span>
                                    <a href="{{route('portal.event.read', $event->event_id)}}"><h4>{{$event->event_title}}</h4></a>
                                    <span><i class="fa fa-map-marker"></i> {{$event->event_place}}</span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="about-bg">
            <img src="{{asset('storage/portal/fronted/images/'. $section->value('home_section_about_image'))}}" alt="About">
        </div>
    </section>
    <section id="apply-aprt" class="pb-120">
        <div class="container">
            <div class="apply">
                <div class="row no-gutters">
                    @php($no = 1)
                    @foreach($sliders as $slider)
                    <div class="col-lg-6">
                        <div class="apply-cont apply-color-{{$no++}}">
                            <h3>{{$slider->slider_title}}</h3>
                            <p>{{$slider->slider_content}}</p>
                            <a href="{{$slider->slider_button_link_2}}" class="main-btn">{{$slider->slider_button_name_2}}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section id="course-part" class="pt-115 pb-120 gray-bg">
        @if($extracurriculars->count() > 5)
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title pb-45">
                        <h5>Kegiatan</h5>
                        <h2>Ekstrakurikuler </h2>
                    </div>
                </div>
            </div>
            <div class="row course-slied mt-30">
                @foreach($extracurriculars as $extracurricular)
                <div class="col-lg-4">
                    <div class="singel-course">
                        <div class="thum">
                            <div class="image">
                                <img src="{{asset($extracurricular->extracurricular_image)}}" alt="Course">
                            </div>
                        </div>
                        <div class="cont">
                            <a href="{{$extracurricular->extracurricular_id}}"><h4>{{$extracurricular->extracurricular_name}}</h4></a>
                            <div class="course-teacher"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </section>
    <section id="video-feature" class="bg_cover pt-60 pb-110" style="background-image: url({{asset($section->value('home_section_yt_background'))}})">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-last order-lg-first">
                    <div class="video text-lg-left text-center pt-50">
                        <a class="Video-popup" href="{{$section->value('home_section_yt_youtube')}}"><i class="fa fa-play"></i></a>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1 order-first order-lg-last">
                    <div class="feature pt-50">
                        <div class="feature-title">
                            <h3>Mengapa Harus Kami?</h3>
                        </div>
                        <ul>
                            <li>
                                <div class="singel-feature">
                                    <div class="icon">
                                        <img src="{{$section->value('home_section_4_icon_1')}}" alt="icon">
                                    </div>
                                    <div class="cont">
                                        <h4>{{$section->value('home_section_4_title_1')}}</h4>
                                        <p>{{$section->value('home_section_4_content_1')}}</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="singel-feature">
                                    <div class="icon">
                                        <img src="{{$section->value('home_section_4_icon_2')}}" alt="icon">
                                    </div>
                                    <div class="cont">
                                        <h4>{{$section->value('home_section_4_title_2')}}</h4>
                                        <p>{{$section->value('home_section_4_content_2')}}</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="singel-feature">
                                    <div class="icon">
                                        <img src="{{$section->value('home_section_4_icon_3')}}" alt="icon">
                                    </div>
                                    <div class="cont">
                                        <h4>{{$section->value('home_section_4_title_3')}}</h4>
                                        <p>{{$section->value('home_section_4_content_3')}}</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="feature-bg"></div>
    </section>
    <section id="teachers-part" class="pt-70 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title mt-50">
                        <h5>Guru & Karyawan</h5>
                        <h2>MTs. Darul Hikmah Menganti</h2>
                    </div>
                    <div class="teachers-cont" style="text-align: justify">
                        <p>Guru yang berkualitas yaitu guru yang memiliki pengetahuan yang baik atau mendalam tentang kurikulum pendidiksn dan mampu mengembangkannya dengan baik serta sesuai dengan aturan pendidikan yang berlaku. Guru yang berkualitas mampu memahami, memperhatikan, dan memiliki metode pembelajaran sesuai dengan kemampuan peserta didiknya.</p>
                        <a href="#" class="main-btn mt-55">Bergabung dengan Kami</a>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="teachers mt-20">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="singel-teachers mt-30 text-center">
                                    <div class="image">
                                        <img src="{{asset('storage/portal/fronted/images/teacher/sholihin.jpg')}}" alt="Teachers">
                                    </div>
                                    <div class="cont">
                                        <a href="#"><h6>Sholihin, S.Ag.</h6></a>
                                        <span>Kepala Madrasah</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="singel-teachers mt-30 text-center">
                                    <div class="image">
                                        <img src="{{asset('storage/portal/fronted/images/teacher/sholihatun.jpg')}}" alt="Teachers">
                                    </div>
                                    <div class="cont">
                                        <a href="#"><h6>Sholihatun, S.Pd.I.</h6></a>
                                        <span>Waka. Kesiswaan</span>
                                    </div>
                                </div> <!-- singel teachers -->
                            </div>
                            <div class="col-sm-6">
                                <div class="singel-teachers mt-30 text-center">
                                    <div class="image">
                                        <img src="{{asset('storage/portal/fronted/images/teacher/puji.jpg')}}" alt="Teachers">
                                    </div>
                                    <div class="cont">
                                        <a href="#"><h6>Fuji Nur Afida, S.Pd.</h6></a>
                                        <span>Guru BK</span>
                                    </div>
                                </div> <!-- singel teachers -->
                            </div>
                            <div class="col-sm-6">
                                <div class="singel-teachers mt-30 text-center">
                                    <div class="image">
                                        <img src="{{asset('storage/portal/fronted/images/teacher/bambang.jpg')}}" alt="Teachers">
                                    </div>
                                    <div class="cont">
                                        <a href="#"><h6>Bambang, S.Pd.</h6></a>
                                        <span>Guru IPS</span>
                                    </div>
                                </div> <!-- singel teachers -->
                            </div>
                        </div> <!-- row -->
                    </div> <!-- teachers -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    <section id="publication-part" class="pt-115 pb-120 gray-bg">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-6 col-md-8 col-sm-7">
                    <div class="section-title pb-60">
                        <h5>Fasilitas -  Fasilitas</h5>
                        <h2>Madrasah </h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-5">
                    <div class="products-btn text-right pb-60">
                        <a href="#" class="main-btn">Lihat Semua</a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($facilities as $facility)
                <div class="col-lg-3 col-md-6 col-sm-8">
                    <div class="singel-publication mt-30">
                        <div class="image">
                            <img src="{{asset($facility->facility_image)}}" alt="Publication">
                        </div>
                        <div class="cont">
                            <div class="name">
                                <a href="{{$facility->faciliy_link}}"><h6>{{$facility->facility_name}}</h6></a>
                                <span>{{$facility->facility_desc}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="testimonial" class="bg_cover pt-115 pb-115" data-overlay="8" style="background-image: url({{asset($section->value('home_section_testi_bg'))}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title pb-40">
                        <h5>Testimoni</h5>
                        <h2>Apa Kata Mereka ?</h2>
                    </div>
                </div>
            </div>
            <div class="row testimonial-slied mt-40">
                @foreach($testimonials as $testimonial)
                <div class="col-lg-6">
                    <div class="singel-testimonial">
                        <div class="testimonial-thum">
                            <img src="{{asset($testimonial->testimonial_image)}}" alt="Testimonial">
                            <div class="quote">
                                <i class="fa fa-quote-right"></i>
                            </div>
                        </div>
                        <div class="testimonial-cont">
                            <p>{{$testimonial->testimonial_desc}} </p>
                            <h6>{{$testimonial->testimonial_name}}</h6>
                            <span>{{$testimonial->testimonial_job}}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="news-part" class="pt-115 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title pb-50">
                        <h5>Artikel Terbaru</h5>
                        <h2>Dari Berita</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="singel-news mt-30">
                        <div class="news-thum pb-25">
                            <img src="{{asset($post_single->post_image)}}" alt="News">
                        </div>
                        <div class="news-cont">
                            <ul>
                                <li><a href="#"><i class="fa fa-calendar"></i>{{$post_single->created_at()}} </a></li>
                                <li><a href="#"> <span>Oleh</span> {{$post_single->user->user_name}}</a></li>
                            </ul>
                            <a href="{{route('potral.article.read', $post_single->post_id)}}"><h3>{{$post_single->post_title}}</h3></a>
                            <p style="text-align: justify">{{Str::limit($post_single->post_content, 200)}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    @foreach($posts as $post)
                    <div class="singel-news news-list">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="news-thum mt-30">
                                    <img src="{{asset($post->post_image)}}" alt="News">
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="news-cont mt-30">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-calendar"></i>{{$post->created_at()}} </a></li>
                                        <li><a href="#"> <span>Oleh</span> {{$post->user->user_name}}</a></li>
                                    </ul>
                                    <a href="{{route('potral.article.read', $post->post_id)}}"><h3>{{$post->post_title}}</h3></a>
                                    <p style="text-align: justify">{{Str::limit($post->post_content, 100)}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <div id="patnar-logo" class="pt-40 pb-80 gray-bg">
        <div class="container">
            <div class="row patnar-slied">
                <div class="col-lg-12">
                    <div class="singel-patnar text-center mt-40">
                        <img src="{{asset('assets/portal/fronted/images/patnar/kemenag.png')}}" alt="Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="singel-patnar text-center mt-40">
                        <img src="{{asset('assets/portal/fronted/images/patnar/kemendikbud.png')}}" alt="Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="singel-patnar text-center mt-40">
                        <img src="{{asset('assets/portal/fronted/images/patnar/ayomondok.png')}}" alt="Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="singel-patnar text-center mt-40">
                        <img src="{{asset('assets/portal/fronted/images/patnar/kemadrasah.png')}}" alt="Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="singel-patnar text-center mt-40">
                        <img src="{{asset('assets/portal/fronted/images/patnar/madrasahhebat.png')}}" alt="Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="singel-patnar text-center mt-40">
                        <img src="{{asset('assets/portal/fronted/images/patnar/ayomadrasah.png')}}" alt="Logo">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
