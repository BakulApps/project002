<div class="card card-sidebar-mobile">
    <ul class="nav nav-sidebar" data-nav-type="accordion">
        <li class="nav-item"><a href="{{route('exam.home')}}" class="nav-link {{$title == 'Dashboard' ? 'active' : null}}"><i class="icon-display"></i><span>Dashboard</span></a></li>
        <li class="nav-item"><a href="{{route('exam.schedule')}}" class="nav-link {{$title == 'Jadwal' ? 'active' : null}}"><i class="icon-calendar"></i><span>Jadwal Ujian</span></a></li>
    </ul>
</div>
