@if(auth('finance')->check())
    <div class="card card-sidebar-mobile">
        <ul class="nav nav-sidebar" data-nav-type="accordion">
            <li class="nav-item"><a href="{{route('finance.home')}}" class="nav-link {{$title == 'Beranda' ? 'active' : null}}"><i class="icon-display"></i><span>Dashboard</span></a></li>
            <li class="nav-item nav-item-submenu">
                <a href="#" class="nav-link {{$title == 'Master Data' ? 'active' : null}}"><i class="icon-box"></i> <span> Master Data</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="Postingan">
                    <li class="nav-item"><a href="{{route('finance.master.item')}}" class="nav-link">Item Pembayaran</a></li>
                    <li class="nav-item"><a href="{{route('finance.master.account')}}" class="nav-link">Akun Bank</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="{{route('finance.student')}}" class="nav-link {{$title == 'Peserta Didik' ? 'active' : null}}"><i class="icon-graduation2"></i><span>Peserta Didik</span></a></li>
            <li class="nav-item"><a href="{{route('finance.invoice')}}" class="nav-link {{$title == 'Tagihan' ? 'active' : null}}"><i class="icon-cart"></i><span>Tagihan</span></a></li>
            <li class="nav-item">
                <a href="{{route('finance.payment')}}" class="nav-link {{$title == 'Pembayaran' ? 'active' : null}}">
                    <i class="icon-credit-card"></i>
                    <span>Pembayaran</span>
                    @if(\App\Models\Finance\Payment::notify() > 0)
                    <span class="badge badge-pill bg-danger-400 align-self-center ml-auto">{{\App\Models\Finance\Payment::notify()}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item"><a href="{{route('finance.setting')}}" class="nav-link {{$title == 'Penganturan' ? 'active' : null}}"><i class="icon-cog"></i><span>Pengaturan</span></a></li>
        </ul>
    </div>
@endif
