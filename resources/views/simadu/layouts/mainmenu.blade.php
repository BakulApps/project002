@if(session()->has('simadu.auth'))
    <div class="card card-sidebar-mobile">
        <ul class="nav nav-sidebar" data-nav-type="accordion">
            <li class="nav-item"><a href="{{route('simadu.home')}}" class="nav-link {{$title == 'Beranda' ? 'active' : null}}"><i class="icon-display"></i><span>Dashboard</span></a></li>
            <li class="nav-item"><a href="{{route('simadu.profile')}}" class="nav-link {{$title == 'Informasi Pribadi' ? 'active' : null}}"><i class="icon-user"></i><span>Informasi Pribadi</span></a></li>
            <li class="nav-item nav-item-submenu">
                <a href="#" class="nav-link {{$title == 'Akademik' ? 'active' : null}}"><i class="icon-book"></i> <span> Akademik</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="Postingan">
                    <li class="nav-item"><a href="{{route('simadu.academic.schedule')}}" class="nav-link">Jadwal Pelajaran</a></li>
                    <li class="nav-item"><a href="{{route('simadu.academic.presence')}}" class="nav-link">Kehadiran</a></li>
                    <li class="nav-item"><a href="{{route('simadu.academic.report')}}" class="nav-link">Raport Online</a></li>
                </ul>
            </li>
            <li class="nav-item nav-item-submenu">
                <a href="#" class="nav-link {{$title == 'Keuangan' ? 'active' : null}}"><i class="icon-credit-card"></i> <span> Keuangan</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="Postingan">
                    <li class="nav-item"><a href="{{route('simadu.finance.invoice')}}" class="nav-link">Tagihan</a></li>
                    <li class="nav-item"><a href="{{route('simadu.finance.payment')}}" class="nav-link">Pembayaran</a></li>
                </ul>
            </li>
        </ul>
    </div>
@endif
