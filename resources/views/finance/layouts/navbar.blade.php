<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-brand">
        <a href="{{route('finance.home')}}" class="d-inline-block">
            <img src="{{asset($setting->value('app_logo') == null ? 'assets/images/logo_light.png' : 'storage/finance/images/'. $setting->value('app_logo'))}}" alt="">
        </a>
    </div>
    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
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
        <a target="_blank" href="{{route('portal.home')}}" class="badge bg-success ml-md-3 mr-md-auto">Kunjungi Situs</a>
        <ul class="navbar-nav navbar-right">
            @if(auth('finance')->check())
                <li class="nav-item dropdown dropdown-user">
                    <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('storage/master/images/'.$school->school_logo)}}" class="rounded-circle mr-2" height="34" alt="">
                        <span>{{auth('finance')->user()->user_fullname}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{route('finance.user')}}" class="dropdown-item"><i class="icon-cog"></i> Pengaturan</a>
                        <a href="{{route('finance.logout')}}" class="dropdown-item"><i class="icon-switch2"></i> Keluar</a>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</div>
