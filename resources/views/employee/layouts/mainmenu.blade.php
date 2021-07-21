<div class="card card-sidebar-mobile">
    <ul class="nav nav-sidebar" data-nav-type="accordion">
        <li class="nav-item"><a href="{{route('employee.home')}}" class="nav-link {{$title == 'Beranda' ? 'active' : null}}"><i class="icon-display"></i><span>Dashboard</span></a></li>
        <li class="nav-item"><a href="{{route('employee.present')}}" class="nav-link {{$title == 'Kehadiran' ? 'active' : null}}"><i class="icon-calendar2"></i><span>Kehadiran</span></a></li>
    </ul>
</div>
