@if(auth('graduate')->check())
    <div class="card card-sidebar-mobile">
        <ul class="nav nav-sidebar" data-nav-type="accordion">
            <li class="nav-item"><a href="{{route('graduate.admin.home')}}" class="nav-link {{$title == 'Dashboard' ? 'active' : null}}"><i class="icon-display"></i><span>Dashboard</span></a></li>
            <li class="nav-item nav-item-submenu">
                <a href="#" class="nav-link {{$title == 'Master Data' ? 'active' : null}}"><i class="icon-box"></i> <span> Master Data</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="Postingan">
                    <li class="nav-item"><a href="{{route('graduate.admin.master.year')}}" class="nav-link">Tahun Pelajaran</a></li>
                    <li class="nav-item"><a href="{{route('graduate.admin.master.subject')}}" class="nav-link">Data Pelajaran</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="{{route('graduate.admin.student')}}" class="nav-link {{$title == 'Peserta Didik' ? 'active' : null}}"><i class="icon-users2"></i><span>Peserta Didik</span></a></li>
            <li class="nav-item nav-item-submenu">
                <a href="#" class="nav-link {{$title == 'Penilaian' ? 'active' : null}}"><i class="icon-chart"></i> <span> Penilaian</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="Postingan">
                    <li class="nav-item"><a href="{{route('graduate.admin.value.semester')}}" class="nav-link">Nilai Semester</a></li>
                    <li class="nav-item"><a href="{{route('graduate.admin.value.exam')}}" class="nav-link">Nilai Ujian</a></li>
                    <li class="nav-item"><a href="{{route('graduate.admin.value.certificate')}}" class="nav-link">Nilai Ijasah</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="{{route('graduate.admin.announcement')}}" class="nav-link {{$title == 'Pengumuman' ? 'active' : null}}"><i class="icon-megaphone"></i><span>Pengumuman</span></a></li>
            <li class="nav-item"><a href="{{route('graduate.admin.setting')}}" class="nav-link {{$title == 'Pengaturan' ? 'active' : null}}"><i class="icon-cog"></i><span>Pengaturan</span></a></li>
        </ul>
    </div>
@endif
