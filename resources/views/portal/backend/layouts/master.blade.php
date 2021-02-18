<!DOCTYPE html>
<html lang="{{Str::of(config('app.locale'))->replace('_', '-')}}">
@include('portal.backend.layouts.head')
<body>
<script type="text/javascript">
    var baseurl = '{{route('portal.admin.home')}}'
</script>
@include('portal.backend.layouts.navbar')
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
                            <a href="#"><img src="{{asset($setting->value('school_logo'))}}" width="40" height="40" alt=""></a>
                        </div>
                        <div class="media-body">
                            <div class="media-title font-weight-semibold">{{$setting->value('school_name')}}</div>
                            <div class="font-size-xs opacity-50">
                                <i class="icon-pin font-size-sm"></i> &nbsp;{{$setting->value('school_address')}} &nbsp; {{$setting->value('school_village')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('portal.backend.layouts.mainmenu')
        </div>
    </div>
    <div class="content-wrapper">
        @include('portal.backend.layouts.header')
        <div class="content">
            @yield('content')
        </div>
        @include('portal.backend.layouts.footer')
    </div>
</div>
@yield('modal')
</body>
</html>
