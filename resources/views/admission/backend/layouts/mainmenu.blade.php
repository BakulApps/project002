<div class="card card-sidebar-mobile">
    <ul class="nav nav-sidebar" data-nav-type="accordion">
        <li class="nav-item"><a href="{{route('admission.admin.home')}}" class="nav-link {{$title == 'Dashboard' ? 'active' : null}}"><i class="icon-display"></i><span>Dashboard</span></a></li>
        <li class="nav-item"><a href="{{route('admission.admin.student')}}" class="nav-link {{in_array($title, ['Data Siswa', 'Tambah Siswa', 'Ubah Siswa']) ? 'active' : null}}"><i class="icon-users"></i><span>Data Siswa</span></a></li>
        <li class="nav-item"><a href="{{route('admission.admin.setting')}}" class="nav-link"><i class="icon-cog"></i><span>Pengaturan</span></a></li>
    </ul>
</div>
