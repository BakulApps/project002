@extends('portal.fronted.layouts.master', ['page' => 'EKSTRAKURIKULER', 'title' => 'Ektrakurikuler'])

@section('content')
    <section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8" style="background-image: url({{$section->value('article_section_title_bg')}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Ekstrakurikuler</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Ekstrakurikuler</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="courses-part" class="pt-120 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="courses-top-search">
                        <ul class="nav float-left" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="active" id="courses-grid-tab" data-toggle="tab" href="#courses-grid" role="tab" aria-controls="courses-grid" aria-selected="true"><i class="fa fa-th-large"></i></a>
                            </li>
                            <li class="nav-item">
                                <a id="courses-list-tab" data-toggle="tab" href="#courses-list" role="tab" aria-controls="courses-list" aria-selected="false"><i class="fa fa-th-list"></i></a>
                            </li>
                            <li class="nav-item">Menampilkan {{$extracurriculars->count()}} dari {{$extracurriculars->total()}} Item</li>
                        </ul>

                        <div class="courses-search float-right">
                            <form action="#">
                                <input type="text" placeholder="Pencarian">
                                <button type="button"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="courses-grid" role="tabpanel" aria-labelledby="courses-grid-tab">
                    <div class="row">
                        @foreach($extracurriculars as $extracurricular)
                        <div class="col-lg-4 col-md-6">
                            <div class="singel-course mt-30">
                                <div class="thum">
                                    <div class="image">
                                        <img src="{{asset('storage/portal/images/extracurricular/'. $extracurricular->extracurricular_image)}}" alt="Course">
                                    </div>
                                </div>
                                <div class="cont">
                                    <ul>
                                        @for($i=0;$i<$extracurricular->extracurricular_review;$i++)
                                            <li><i class="fa fa-star"></i></li>
                                        @endfor
                                    </ul>
                                    <span>({{$extracurricular->extracurricular_review}} Rating)</span><br/>
                                    <a href="{{route('portal.extracurricular.read', $extracurricular->extracurricular_id)}}"><h4>
                                        {{$extracurricular->extracurricular_name}}</h4></a>
                                    <div class="course-teacher">
                                        <div class="thum">
                                            <a href="#"><img src="{{asset('assets/apps/portal/images/placeholder.jpg')}}" alt="teacher"></a>
                                        </div>
                                        <div class="name">
                                            <a href="#"><h6>{{$extracurricular->extracurricular_teacher}}</h6></a>
                                        </div>
                                        <div class="admin">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-user"></i><span> {{$extracurricular->extracurricular_student}}</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                @if($extracurriculars->lastPage() > 1)
                    <div class="col-lg-12">

                        <nav class="courses-pagination mt-50">
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a href="{{$extracurriculars->currentPage() == 1 ? '#' : $extracurriculars->previousPageUrl()}}" aria-label="Previous"><i class="fa fa-angle-left"></i></a>
                                </li>
                                @for($i=1;$i <= $extracurriculars->lastPage(); $i++)
                                    <li class="page-item"><a class="{{$extracurriculars->currentPage() == $i ? 'active' : null}}" href="{{$extracurriculars->url($i)}}">{{$i}}</a></li>
                                @endfor
                                <li class="page-item">
                                    <a href="{{$extracurriculars->currentPage() == $extracurriculars->lastPage() ? '#' :$extracurriculars->nextPageUrl()}}" aria-label="Next">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                @endif
            </div>  <!-- row -->
        </div> <!-- container -->
    </section>
@endsection
