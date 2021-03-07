<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-brand">
        <a href="{{route('admission.home')}}" class="d-inline-block">
            <img src="{{asset('assets/sites/admission/fronted/images/logo_light.png')}}" alt="">
        </a>
    </div>
    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-component-toggle" type="button">
            <i class="icon-unfold"></i>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>
        <span class="badge bg-success ml-md-3 mr-md-auto">Terhubung</span>
        <ul class="navbar-nav">
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('storage/admission/fronted/images/logo.png')}}" class="rounded-circle mr-2" height="34" alt="">
                    <span>{{auth('admission')->user()->user_fullname}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item"><i class="icon-cog5"></i> Pengaturan</a>
                    <a href="{{route('admission.logout')}}" class="dropdown-item"><i class="icon-switch2"></i> Keluar</a>
                </div>
            </li>
        </ul>
    </div>
</div>
</div>
