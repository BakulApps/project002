<!DOCTYPE html>
<html lang="{{Str::of(config('app.locale'))->replace('_', '-')}}">
    @include('exam.layouts.head')
    <body>
    <script type="text/javascript">
        var baseurl = "{{route('exam.home')}}";
        var adminurl = "{{route('exam.admin.home')}}";
    </script>
        @include('exam.layouts.navbar')
        <div class="page-content">
            <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
                <div class="sidebar-mobile-toggler text-center">
                    <a href="#" class="sidebar-mobile-main-toggle"><i class="icon-arrow-left8"></i></a>
                    Navigasi
                    <a href="#" class="sidebar-mobile-expand"><i class="icon-screen-full"></i><i class="icon-screen-normal"></i></a>
                </div>
                <div class="sidebar-content">
                    <div class="sidebar-user">
                        <div class="card-body">
                            <div class="media">
                                <div class="mr-2">
                                    <a href="#"><img src="{{asset('storage/exam/fronted/images/'.$setting->value('school_logo'))}}" width="50" height="50"></a>
                                </div>
                                <div class="media-body">
                                    <div class="media-title font-weight-semibold">{{$setting->value('school_name')}}</div>
                                    <div class="font-size-xs opacity-50">
                                        <i class="icon-pin font-size-sm"></i> &nbsp;{{$setting->value('school_address')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('exam.layouts.mainmenu')
                </div>
            </div>
            <div class="content-wrapper">
                @include('exam.layouts.header')
                <div class="content">
                    @yield('content')
                </div>
                @include('exam.layouts.footer')
            </div>
        </div>
    @yield('modal')
    </body>
</html>
