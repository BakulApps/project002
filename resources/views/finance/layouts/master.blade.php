<!DOCTYPE html>
<html lang="{{Str::of(config('app.locale'))->replace('_', '-')}}">
@include('finance.layouts.head')
<body>
<script type="text/javascript">
    var siteurl = "{{route('portal.home')}}"
    var baseurl = "{{route('finance.home')}}";
</script>
@include('finance.layouts.navbar')
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
                @include('finance.layouts.mainmenu')
            </div>
        </div>
        <div class="content-wrapper">
            @include('finance.layouts.header')
            <div class="content">
                @yield('content')
            </div>
            @include('finance.layouts.footer')
        </div>
    </div>
    @yield('modal')
</body>
</html>
