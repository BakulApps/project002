<!doctype html>
<html lang="{{Str::of(config('app.locale'))->replace('_', '-')}}">
    @include('portal.fronted.layouts.head')
    <body>
    <div class="preloader">
        <div class="loader rubix-cube">
            <div class="layer layer-1"></div>
            <div class="layer layer-2"></div>
            <div class="layer layer-3 color-1"></div>
            <div class="layer layer-4"></div>
            <div class="layer layer-5"></div>
            <div class="layer layer-6"></div>
            <div class="layer layer-7"></div>
            <div class="layer layer-8"></div>
        </div>
    </div>
    <header id="header-part">
        @include('portal.fronted.layouts.navbar')
        @include('portal.fronted.layouts.header')
        @include('portal.fronted.layouts.mainmenu')
    </header>
    <div class="search-box">
        <div class="serach-form">
            <div class="closebtn">
                <span></span>
                <span></span>
            </div>
            <form action="#">
                <input type="text" placeholder="Ketikan sebuah kata...">
                <button><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
    @yield('content')
    @include('portal.fronted.layouts.footer')
    @include('portal.fronted.layouts.script')
    </body>
</html>
