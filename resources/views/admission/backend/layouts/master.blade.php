<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
    @include('admission.backend.layouts.head')
    <body>
    <script type="text/javascript">
        var baseurl = "{{route('admission.home')}}" + "/admin";
        var siteurl = "{{route('portal.home')}}";
    </script>
        @include('admission.backend.layouts.navbar')
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
                                    <a href="#"><img src="{{asset('storage/master/images/'.$school->school_logo)}}" width="50" height="50"></a>
                                </div>
                                <div class="media-body">
                                    <div class="media-title font-weight-semibold">{{$school->name(false)}}</div>
                                    <div class="font-size-xs opacity-50">
                                        <i class="icon-pin font-size-sm"></i> &nbsp;{{$school->value('school_address')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('admission.backend.layouts.mainmenu')
                </div>
            </div>
            <div class="content-wrapper">
                @include('admission.backend.layouts.header')
                <div class="content">
                    @yield('content')
                </div>
                @include('admission.backend.layouts.footer')
            </div>
        </div>
    @yield('modal')
    </body>
</html>
