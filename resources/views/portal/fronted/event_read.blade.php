@extends('portal.fronted.layouts.master')
@section('content')
    <section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8" style="background-image: url(images/page-banner-3.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>{{$event->event_title}}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="#">Acara & Kegiatan</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$event->event_title}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="event-singel" class="pt-120 pb-120 gray-bg">
        <div class="container">
            <div class="events-area">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="events-left">
                            <h3>{{$event->event_title}}</h3>
                            <a href="#"><span><i class="fa fa-calendar"></i> {{$event->date_start()}}</span></a>
                            <a href="#"><span><i class="fa fa-map-marker"></i> {{$event->event_place}}</span></a>
                            <img src="{{asset('storage/portal/fronted/images/event/'. $event->event_image)}}" alt="Event">
                            <p>{{$event->event_content}}</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="events-right">
                            <div class="events-coundwon bg_cover" data-overlay="8" style="background-image: url(images/event/singel-event/coundown.jpg)">
                                <div data-countdown="2020/03/12"></div>
                                <div class="events-coundwon-btn pt-30">
                                    <a href="#" class="main-btn">Book Your Seat</a>
                                </div>
                            </div>
                            <div class="events-address mt-30">
                                <ul>
                                    <li>
                                        <div class="singel-address">
                                            <div class="icon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            <div class="cont">
                                                <h6>Tanggal Mulai</h6>
                                                <span>{{$event->date_start()}}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="singel-address">
                                            <div class="icon">
                                                <i class="fa fa-bell-slash"></i>
                                            </div>
                                            <div class="cont">
                                                <h6>Tanggal Selesai</h6>
                                                <span>{{$event->date_end()}}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="singel-address">
                                            <div class="icon">
                                                <i class="fa fa-map"></i>
                                            </div>
                                            <div class="cont">
                                                <h6>Lokasi</h6>
                                                <span>{{$event->event_place}}</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div id="contact-map" class="mt-25"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
