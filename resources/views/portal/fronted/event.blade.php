@extends('portal.fronted.layouts.master')
@section('content')
    <section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8" style="background-image: url(images/page-banner-3.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Events</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$page}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="event-page" class="pt-90 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                @foreach($events as $event)
                <div class="col-lg-6">
                    <div class="singel-event-list mt-30">
                        <div class="event-thum">
                            <img src="{{asset($event->event_image == null ?'assets/apps/portal/images/blog-1.jpg' : 'storage/portal/images/event/'. $event->event_image)}}" alt="Event">
                        </div>
                        <div class="event-cont">
                            <span><i class="fa fa-calendar"></i> {{$event->date_start() .' - '. $event->date_end()}}</span>
                            <a href="{{route('portal.event.read', $event->event_id)}}"><h4>{{$event->event_title}}</h4></a>
                            <span><i class="fa fa-map-marker"></i> {{$event->event_place}}</span>
                            <p style="text-align: justify">{{strip_tags(Str::limit($event->event_content, 100))}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if($events->lastPage() > 1)
                    <nav class="courses-pagination mt-50">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a href="{{$events->currentPage() == 1 ? '#' : $events->previousPageUrl()}}" aria-label="Previous"><i class="fa fa-angle-left"></i></a>
                            </li>
                            @for($i=1;$i <= $events->lastPage(); $i++)
                                <li class="page-item"><a class="{{$events->currentPage() == $i ? 'active' : null}}" href="{{$events->url($i)}}">{{$i}}</a></li>
                            @endfor
                            <li class="page-item">
                                <a href="{{$events->currentPage() == $events->lastPage() ? '#' :$events->nextPageUrl()}}" aria-label="Next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </section>
@endsection
