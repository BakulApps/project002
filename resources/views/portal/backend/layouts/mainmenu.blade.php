<div class="card card-sidebar-mobile">
    <ul class="nav nav-sidebar" data-nav-type="accordion">
        <li class="nav-item"><a href="{{route('portal.admin.home')}}" class="nav-link"><i class="icon-display"></i><span> Beranda</span></a></li>
        <li class="nav-item nav-item-submenu">
            <a href="#" class="nav-link"><i class="icon-newspaper2"></i> <span> Postingan</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="Postingan">
                <li class="nav-item"><a href="{{route('portal.admin.article.all')}}" class="nav-link">Semua</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.article.create')}}" class="nav-link">Buat Postingan</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.article.category')}}" class="nav-link">Kategori</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.article.tag')}}" class="nav-link">Tagar</a></li>
            </ul>
        </li>
{{--        <li class="nav-item nav-item-submenu">--}}
{{--            <a href="#" class="nav-link"><i class="icon-snowflake"></i> <span> Acara/Kegiatan</span></a>--}}
{{--            <ul class="nav nav-group-sub" data-submenu-title="Postingan">--}}
{{--                <li class="nav-item"><a href="{{route('portal.event.all')}}" class="nav-link">Semua</a></li>--}}
{{--                <li class="nav-item"><a href="{{route('portal.event.create')}}" class="nav-link">Buat Postingan</a></li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a href="{{route('portal.comment.all')}}" class="nav-link">--}}
{{--                <i class="icon-comment"></i>--}}
{{--                <span>Komentar</span>--}}
{{--                <span class="badge bg-blue-400 align-self-center ml-auto">{{\App\Models\Comment::unread()}}</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a href="{{route('portal.message.all')}}" class="nav-link">--}}
{{--                <i class="icon-mailbox"></i>--}}
{{--                <span>Perpesanan</span>--}}
{{--                <span class="badge bg-blue-400 align-self-center ml-auto">{{\App\Models\Message::unred()}}</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        @if(auth('user')->user()->user_role == 1)--}}
{{--        <li class="nav-item">--}}
{{--            <a href="{{route('portal.user')}}" class="nav-link"><i class="icon-user"></i> <span> Pengguna</span></a>--}}
{{--        </li>--}}
{{--        @endif--}}
{{--        <li class="nav-item"><a href="{{route('portal.setting')}}" class="nav-link"><i class="icon-cog"></i><span>Pengaturan</span></a></li>--}}
    </ul>
</div>
