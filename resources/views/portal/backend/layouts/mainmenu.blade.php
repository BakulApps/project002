<div class="card card-sidebar-mobile">
    <ul class="nav nav-sidebar" data-nav-type="accordion">
        <li class="nav-item"><a href="{{route('portal.admin.home')}}" class="nav-link"><i class="icon-display"></i><span> Beranda</span></a></li>
        <li class="nav-item nav-item-submenu">
            <a href="#" class="nav-link"><i class="icon-newspaper2"></i> <span> Postingan</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="Postingan">
                <li class="nav-item"><a href="{{route('portal.admin.post.all')}}" class="nav-link">Semua</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.post.create')}}" class="nav-link">Buat Postingan</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.post.category')}}" class="nav-link">Kategori</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.post.tag')}}" class="nav-link">Tagar</a></li>
            </ul>
        </li>
{{--        <li class="nav-item nav-item-submenu">--}}
{{--            <a href="#" class="nav-link"><i class="icon-snowflake"></i> <span> Acara/Kegiatan</span></a>--}}
{{--            <ul class="nav nav-group-sub" data-submenu-title="Postingan">--}}
{{--                <li class="nav-item"><a href="{{route('portal.event.all')}}" class="nav-link">Semua</a></li>--}}
{{--                <li class="nav-item"><a href="{{route('portal.event.create')}}" class="nav-link">Buat Postingan</a></li>--}}
{{--            </ul>--}}
{{--        </li>--}}
        <li class="nav-item">
            <a href="{{route('portal.admin.comment.all')}}" class="nav-link">
                <i class="icon-comment"></i>
                <span>Komentar</span>
                <span class="badge bg-blue-400 align-self-center ml-auto">{{\App\Models\Portal\Comment::unread()}}</span>
            </a>
        </li>
        <li class="nav-item nav-item-submenu">
            <a href="#" class="nav-link"><i class="icon-file-empty"></i> <span> Halaman</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="Postingan">
                <li class="nav-item"><a href="{{route('portal.admin.page.slider')}}" class="nav-link">Slider</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.post.create')}}" class="nav-link">Buat Postingan</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.post.category')}}" class="nav-link">Kategori</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.post.tag')}}" class="nav-link">Tagar</a></li>
            </ul>
        </li>
{{--        <li class="nav-item">--}}
{{--            <a href="{{route('portal.message.all')}}" class="nav-link">--}}
{{--                <i class="icon-mailbox"></i>--}}
{{--                <span>Perpesanan</span>--}}
{{--                <span class="badge bg-blue-400 align-self-center ml-auto">{{\App\Models\Message::unred()}}</span>--}}
{{--            </a>--}}
{{--        </li>--}}
        @if(auth('portal')->user()->user_role == 1)
        <li class="nav-item">
            <a href="{{route('portal.admin.user')}}" class="nav-link"><i class="icon-user"></i> <span> Pengguna</span></a>
        </li>
        @endif
        <li class="nav-item"><a href="{{route('portal.admin.setting')}}" class="nav-link"><i class="icon-cog"></i><span>Pengaturan</span></a></li>
    </ul>
</div>
