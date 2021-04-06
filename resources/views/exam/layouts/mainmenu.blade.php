@if(session()->get('exam.auth'))
    <div class="card card-sidebar-mobile">
        <ul class="nav nav-sidebar" data-nav-type="accordion">
            <li class="nav-item"><a href="{{route('exam.home')}}" class="nav-link {{$title == 'Dashboard' ? 'active' : null}}"><i class="icon-display"></i><span>Dashboard</span></a></li>
            <li class="nav-item"><a href="{{route('exam.schedule')}}" class="nav-link {{$title == 'Jadwal' ? 'active' : null}}"><i class="icon-calendar"></i><span>Jadwal Ujian</span></a></li>
        </ul>
    </div>
@endif

@if(auth('exam')->check())
    <div class="card card-sidebar-mobile">
        <ul class="nav nav-sidebar" data-nav-type="accordion">
            <li class="nav-item"><a href="{{route('exam.admin.home')}}" class="nav-link {{$title == 'Beranda' ? 'active' : null}}"><i class="icon-display"></i><span>Dashboard</span></a></li>
            <li class="nav-item nav-item-submenu">
                <a href="#" class="nav-link {{$title == 'Master Data' ? 'active' : null}}"><i class="icon-box"></i> <span> Master Data</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="Postingan">
                    <li class="nav-item"><a href="{{route('exam.admin.data.subject')}}" class="nav-link">Mata Pelajaran</a></li>
                    <li class="nav-item"><a href="{{route('exam.admin.data.level')}}" class="nav-link">Data Tingkat</a></li>
                    <li class="nav-item"><a href="{{route('exam.admin.data.major')}}" class="nav-link">Data Jurusan</a></li>
                    <li class="nav-item"><a href="{{route('exam.admin.data.class')}}" class="nav-link">Data Rombel</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="{{route('exam.admin.student')}}" class="nav-link {{$title == 'Peserta' ? 'active' : null}}"><i class="icon-users2"></i><span>Peserta Ujian</span></a></li>
            <li class="nav-item"><a href="{{route('exam.admin.schedule')}}" class="nav-link {{$title == 'Jadwal' ? 'active' : null}}"><i class="icon-calendar2"></i><span>Jadwal Ujian</span></a></li>
            <li class="nav-item"><a href="{{route('exam.admin.user')}}" class="nav-link {{$title == 'Pengguna' ? 'active' : null}}"><i class="icon-user"></i><span>Pengguna</span></a></li>
            <li class="nav-item"><a href="{{route('exam.admin.setting')}}" class="nav-link {{$title == 'Pengaturan' ? 'active' : null}}"><i class="icon-cog"></i><span>Pengaturan</span></a></li>
        </ul>
    </div>
@endif
