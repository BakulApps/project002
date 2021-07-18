<div class="card card-sidebar-mobile">
    <ul class="nav nav-sidebar" data-nav-type="accordion">
        <li class="nav-item"><a href="{{route('portal.admin.home')}}" class="nav-link {{$title == 'Dashboard' ? 'active' : null}}"><i class="icon-display"></i><span> Beranda</span></a></li>
        <li class="nav-item nav-item-submenu">
            <a href="#" class="nav-link {{$title == 'Postingan' ? 'active' : null}}"><i class="icon-newspaper2"></i> <span> Postingan</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="Postingan">
                <li class="nav-item"><a href="{{route('portal.admin.post.all')}}" class="nav-link">Semua</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.post.create')}}" class="nav-link">Buat Postingan</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.post.category')}}" class="nav-link">Kategori</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.post.tag')}}" class="nav-link">Tagar</a></li>
            </ul>
        </li>
        <li class="nav-item {{$title == 'Komentar' ? 'active' : null}}">
            <a href="{{route('portal.admin.comment.all')}}" class="nav-link">
                <i class="icon-comment"></i>
                <span>Komentar</span>
                <span class="badge bg-blue-400 align-self-center ml-auto">{{\App\Models\Portal\Comment::unread()}}</span>
            </a>
        </li>
        <li class="nav-item nav-item-submenu">
            <a href="#" class="nav-link {{$title == 'Halaman' ? 'active' : null}}"><i class="icon-file-empty"></i> <span> Halaman</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="Postingan">
                <li class="nav-item"><a href="{{route('portal.admin.page.home')}}" class="nav-link">Beranda</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.page.post')}}" class="nav-link">Postingan</a></li>
            </ul>
        </li>
        <li class="nav-item nav-item-submenu">
            <a href="#" class="nav-link {{$title == 'Acara & Kegiatan' ? 'active' : null}}"><i class="icon-newspaper2"></i> <span> Acara & Kegiatan</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="Postingan">
                <li class="nav-item"><a href="{{route('portal.admin.event.all')}}" class="nav-link">Semua</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.event.create')}}" class="nav-link">Buat Acara/Kegiatan</a></li>
            </ul>
        </li>
        <li class="nav-item nav-item-submenu">
            <a href="#" class="nav-link {{$title == 'Widget' ? 'active' : null}}"><i class="icon-puzzle"></i> <span> Widget</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="Postingan">
                <li class="nav-item"><a href="{{route('portal.admin.widget.slider')}}" class="nav-link">Slider</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.widget.program')}}" class="nav-link">Program</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.widget.extracurricular')}}" class="nav-link">Ekstrakurikuler</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.widget.teacher')}}" class="nav-link">Guru</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.widget.facility')}}" class="nav-link">Fasilitas</a></li>
                <li class="nav-item"><a href="{{route('portal.admin.widget.testimonial')}}" class="nav-link">Testimoni</a></li>
            </ul>
        </li>
        <li class="nav-item"><a href="{{route('portal.admin.mainmenu')}}" class="nav-link {{$title == 'Mainmenu' ? 'active' : null}}"><i class="icon-list"></i><span>Mainmenu</span></a></li>
        @if(auth('portal')->user()->user_role == 1)
        <li class="nav-item">
            <a href="{{route('portal.admin.user')}}" class="nav-link {{$title == 'Pengguna' ? 'active' : null}}"><i class="icon-user"></i> <span> Pengguna</span></a>
        </li>
        @endif
        <li class="nav-item"><a href="{{route('portal.admin.setting')}}" class="nav-link {{$title == 'Pengaturan' ? 'active' : null}}"><i class="icon-cog"></i><span>Pengaturan</span></a></li>
    </ul>
</div>
