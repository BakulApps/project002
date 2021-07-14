<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-brand">
        <a href="{{route('graduate.admin.home')}}" class="d-inline-block">
            <img src="{{asset('assets/apps/graduate/images/logo_light.png')}}" alt="">
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
        <a target="_blank" href="{{route('potral.home')}}" class="badge bg-success ml-md-3 mr-md-auto">Kunjungi Situs</a>
        <ul class="navbar-nav navbar-right">
            @if(session()->has('exam.auth'))
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('storage/exam/images/'.$setting->value('school_logo'))}}" class="rounded-circle mr-2" height="34" alt="">
                    <span>{{\App\Models\Exam\Student::where('student_id', session()->get('exam.auth'))->value('student_name')}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('exam.logout')}}" class="dropdown-item"><i class="icon-switch2"></i> Keluar</a>
                </div>
            </li>
            @endif
                @if(auth('graduate')->check())
                    <li class="nav-item dropdown dropdown-user">
                        <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('storage/graduate/images/'.$setting->value('school_logo'))}}" class="rounded-circle mr-2" height="34" alt="">
                            <span>{{auth('graduate')->user()->user_fullname}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{route('graduate.admin.setting')}}" class="dropdown-item"><i class="icon-cog"></i> Pengaturan</a>
                            <a href="{{route('graduate.admin.logout')}}" class="dropdown-item"><i class="icon-switch2"></i> Keluar</a>
                        </div>
                    </li>
                @endif
        </ul>
    </div>
</div>
