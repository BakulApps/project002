@extends('portal.fronted.layouts.master', ['page' => 'FASILITAS', 'title' => 'Fasilitas'])

@section('content')
    <section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8" style="background-image: url({{$section->value('article_section_title_bg')}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Fasilitas Madrasah</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Fasilitas</li>
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
                            <li class="nav-item">Menampilkan {{$facilities->count()}} dari {{$facilities->total()}} Item</li>
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
                        @foreach($facilities as $facility)
                        <div class="col-lg-4 col-md-6">
                            <div class="singel-course mt-30">
                                <div class="thum">
                                    <div class="image">
                                        <img src="{{$facility->facility_image == null ? asset('assets/apps/portal/images/blog-1.jpg') : asset('storage/portal/images/facility/'. $facility->facility_image)}}" alt="Course">
                                    </div>
                                </div>
                                <div class="cont">
                                    <a href="{{route('portal.extracurricular.read', $facility->facility_id)}}"><h4>{{$facility->facility_name}}</h4></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                @if($facilities->lastPage() > 1)
                    <div class="col-lg-12">

                        <nav class="courses-pagination mt-50">
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a href="{{$facilities->currentPage() == 1 ? '#' : $facilities->previousPageUrl()}}" aria-label="Previous"><i class="fa fa-angle-left"></i></a>
                                </li>
                                @for($i=1;$i <= $facilities->lastPage(); $i++)
                                    <li class="page-item"><a class="{{$facilities->currentPage() == $i ? 'active' : null}}" href="{{$facilities->url($i)}}">{{$i}}</a></li>
                                @endfor
                                <li class="page-item">
                                    <a href="{{$facilities->currentPage() == $facilities->lastPage() ? '#' :$facilities->nextPageUrl()}}" aria-label="Next">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
