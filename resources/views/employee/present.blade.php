@extends('employee.layouts.master', ['title' => 'Beranda'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Kehadiran</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white pb-0 pt-sm-0 pr-sm-0 header-elements-sm-inline">
                    <h6 class="card-title font-weight-semibold">KEHADIRAN</h6>
                    <div class="header-elements">
                        <ul class="nav nav-tabs nav-tabs-bottom card-header-tabs mx-0">
                            <li class="nav-item">
                                <a href="#card-present-1" class="nav-link active" data-toggle="tab">
                                    <i class="icon-calendar2 mr-2"></i>
                                    MTs & MA
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#card-present-2" class="nav-link" data-toggle="tab">
                                    <i class="icon-calendar2 mr-2"></i>
                                    BOCIL
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body tab-content">
                    <div class="tab-pane fade show active" id="card-present-1">
                        <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSeQ6HCdCPUqyMsc6ph411AEgP0EZ4VTkiULmHJWfiKaPcc8Mg/viewform?embedded=true" class="iframe"  frameborder="0" marginheight="0" marginwidth="0">Memuat…</iframe>
                    </div>
                    <div class="tab-pane fade" id="card-present-2">
                        <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSe9iQwkVu-Lf8zdyFwo9MTfLvaokf033Qw5r2rQqWxOy4UjPg/viewform?embedded=true" class="iframe" frameborder="0" marginheight="0" marginwidth="0">Memuat…</iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h6 class="card-title font-weight-semibold">Informasi</h6>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    <style>
        .iframe {
            width: 640px;
            height: 800px
        }
        @media (max-width: 499px){
            .iframe {
                width: 100%;
                height: 900px;
            }
        }
    </style>
@endsection


