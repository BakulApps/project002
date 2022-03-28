<div class="card card-sidebar-mobile">
    <ul class="nav nav-sidebar" data-nav-type="accordion">
        <li class="nav-item"><a href="{{route('admission.home')}}" class="nav-link {{$title == 'Dashboard' ? 'active' : null}}"><i class="icon-display"></i><span>Dashboard</span></a></li>
        <li class="nav-item"><a href="{{route('admission.register')}}" class="nav-link {{$title == 'Pendaftaran' ? 'active' : null}}"><i class="icon-file-plus"></i><span>Pendaftaran</span></a></li>
        @if(Session::has('auth'))
        <li class="nav-item"><a href="{{route('admission.payment')}}" class="nav-link {{$title == 'Pembayaran Tagihan' ? 'active' : null}}"><i class="icon-coin-dollar"></i><span>Pembayaran</span></a></li>
        @endif
        <li class="nav-item"><a href="{{route('admission.term')}}" class="nav-link" {{$title == 'Informasi Pendaftaran' ? 'active' : null}}><i class="icon-newspaper2"></i><span>Informasi</span></a></li>
    </ul>
</div>
