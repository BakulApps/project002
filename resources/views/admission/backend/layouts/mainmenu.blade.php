<div class="card card-sidebar-mobile">
    <ul class="nav nav-sidebar" data-nav-type="accordion">
        <li class="nav-item"><a href="{{route('admission.admin.home')}}" class="nav-link {{$title == 'Dashboard' ? 'active' : null}}"><i class="icon-display"></i><span>Dashboard</span></a></li>
        <li class="nav-item nav-item-submenu">
            <a href="#" class="nav-link {{in_array($title, ['Data Program', 'Data Biaya']) ? 'active' : null}}"><i class="icon-file-zip"></i> <span> Master Data</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="Master Data">
                <li class="nav-item"><a href="{{route('admission.admin.master.program')}}" class="nav-link">Data Program</a></li>
                <li class="nav-item"><a href="{{route('admission.admin.master.cost')}}" class="nav-link">Data Biaya Pendaftaran</a></li>
                <li class="nav-item"><a href="{{route('admission.admin.master.register')}}" class="nav-link">Daftar Ulang</a></li>
            </ul>
        </li>
        <li class="nav-item"><a href="{{route('admission.admin.student')}}" class="nav-link {{in_array($title, ['Data Siswa', 'Tambah Siswa', 'Ubah Siswa']) ? 'active' : null}}"><i class="icon-users"></i><span>Data Siswa</span></a></li>
        <li class="nav-item"><a href="{{route('admission.admin.user')}}" class="nav-link {{$title == 'Pengguna' ? 'active' : null}}"><i class="icon-user"></i><span>Data Pengguna</span></a></li>
        <li class="nav-item"><a href="{{route('admission.admin.setting')}}" class="nav-link {{$title == 'Pengaturan' ? 'active' : null}}"><i class="icon-cog"></i><span>Pengaturan</span></a></li>
    </ul>
</div>
