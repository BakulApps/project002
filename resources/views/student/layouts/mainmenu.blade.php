@if(auth('student')->check())
    <div class="card card-sidebar-mobile">
        <ul class="nav nav-sidebar" data-nav-type="accordion">
            <li class="nav-item"><a href="{{route('student.backend.home')}}" class="nav-link {{$title == 'Beranda' ? 'active' : null}}"><i class="icon-display"></i><span>Dashboard</span></a></li>
            <li class="nav-item nav-item-submenu">
                <a href="#" class="nav-link {{$title == 'Master Data' ? 'active' : null}}"><i class="icon-box"></i> <span> Master Data</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="Postingan">
                    <li class="nav-item"><a href="{{route('student.backend.master.year')}}" class="nav-link">Tahun Pelajaran</a></li>
                    <li class="nav-item"><a href="{{route('student.backend.master.classes')}}" class="nav-link">Data Kelas</a></li>
                    <li class="nav-item"><a href="{{route('student.backend.master.school')}}" class="nav-link">Data Madrasah</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="{{route('student.backend.student.all')}}" class="nav-link {{$title == 'Peserta Didik' ? 'active' : null}}"><i class="icon-users"></i><span>Peserta Didik</span></a></li>
            <li class="nav-item"><a href="{{route('student.backend.setting')}}" class="nav-link {{$title == 'Pengaturan' ? 'active' : null}}"><i class="icon-cog"></i><span>Pengaturan</span></a></li>
        </ul>
    </div>
@endif
@if(session()->has('student.auth'))
    <div class="card card-sidebar-mobile">
        <ul class="nav nav-sidebar" data-nav-type="accordion">
            <li class="nav-item"><a href="{{route('student.home')}}" class="nav-link {{$title == 'Beranda' ? 'active' : null}}"><i class="icon-display"></i><span>Dashboard</span></a></li>
            <li class="nav-item"><a href="{{route('student.profile')}}" class="nav-link {{$title == 'Informasi Pribadi' ? 'active' : null}}"><i class="icon-user"></i><span>Informasi Pribadi</span></a></li>
            <li class="nav-item nav-item-submenu">
                <a href="#" class="nav-link {{$title == 'Akademik' ? 'active' : null}}"><i class="icon-book"></i> <span> Akademik</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="Postingan">
                    <li class="nav-item"><a href="{{route('student.academic.schedule')}}" class="nav-link">Jadwal Pelajaran</a></li>
                    <li class="nav-item"><a href="{{route('student.academic.presence')}}" class="nav-link">Kehadiran</a></li>
                    <li class="nav-item"><a href="{{route('student.academic.report')}}" class="nav-link">Raport Online</a></li>
                </ul>
            </li>
            <li class="nav-item nav-item-submenu">
                <a href="#" class="nav-link {{$title == 'Keuangan' ? 'active' : null}}"><i class="icon-credit-card"></i> <span> Keuangan</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="Postingan">
                    <li class="nav-item"><a href="{{route('student.finance.invoice')}}" class="nav-link">Tagihan</a></li>
                    <li class="nav-item"><a href="{{route('student.finance.payment')}}" class="nav-link">Pembayaran</a></li>
                </ul>
            </li>
        </ul>
    </div>
@endif
