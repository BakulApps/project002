@if(auth('student')->check())
    <div class="card card-sidebar-mobile">
        <ul class="nav nav-sidebar" data-nav-type="accordion">
            <li class="nav-item"><a href="{{route('student.home')}}" class="nav-link {{$title == 'Beranda' ? 'active' : null}}"><i class="icon-display"></i><span>Dashboard</span></a></li>
            <li class="nav-item nav-item-submenu">
                <a href="#" class="nav-link {{$title == 'Master Data' ? 'active' : null}}"><i class="icon-box"></i> <span> Master Data</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="Postingan">
                    <li class="nav-item"><a href="{{route('student.master.year')}}" class="nav-link">Tahun Pelajaran</a></li>
                    <li class="nav-item"><a href="{{route('student.master.classes')}}" class="nav-link">Data Kelas</a></li>
                    <li class="nav-item"><a href="{{route('student.master.school')}}" class="nav-link">Data Madrasah</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="{{route('student.student.all')}}" class="nav-link {{$title == 'Peserta Didik' ? 'active' : null}}"><i class="icon-users"></i><span>Peserta Didik</span></a></li>
            <li class="nav-item"><a href="{{route('student.setting')}}" class="nav-link {{$title == 'Pengaturan' ? 'active' : null}}"><i class="icon-cog"></i><span>Pengaturan</span></a></li>
        </ul>
    </div>
@endif
