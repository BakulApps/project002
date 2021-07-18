@extends('portal.fronted.layouts.master', ['page' => 'PROFIL MADRASAH', 'title' => 'PENDIDIK & TENAGA KEPENDIDIKAN'])

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
                                <li class="breadcrumb-item active" aria-current="page">Pendidik & Tenaga Kependidikan</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="teachers-page" class="pt-90 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                @foreach($teachers as $teacher)
                <div class="col-lg-3 col-sm-6">
                    <div class="singel-teachers mt-30 text-center">
                        <div class="image">
                            <img src="{{asset($teacher->teacher_image == null ? 'assets/apps/portal/images/blog-1.jpg' : 'storage/portal/images/teacher/'. $teacher->teacher_image)}}" alt="Teachers">
                        </div>
                        <div class="cont">
                            <a href="{{route('portal.teacher.read', $teacher->teacher_id)}}"><h6>{{$teacher->teacher_name}}</h6></a>
                            <span>{{$teacher->teacher_job}}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                @if($teachers->lastPage() > 1)
                <div class="col-lg-12">

                        <nav class="courses-pagination mt-50">
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a href="{{$teachers->currentPage() == 1 ? '#' : $teachers->previousPageUrl()}}" aria-label="Previous"><i class="fa fa-angle-left"></i></a>
                                </li>
                                @for($i=1;$i <= $teachers->lastPage(); $i++)
                                    <li class="page-item"><a class="{{$teachers->currentPage() == $i ? 'active' : null}}" href="{{$teachers->url($i)}}">{{$i}}</a></li>
                                @endfor
                                <li class="page-item">
                                    <a href="{{$teachers->currentPage() == $teachers->lastPage() ? '#' :$teachers->nextPageUrl()}}" aria-label="Next">
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
