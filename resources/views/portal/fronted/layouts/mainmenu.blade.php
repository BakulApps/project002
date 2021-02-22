<div class="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-9 col-8">
                <nav class="navbar navbar-expand-lg">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a @if($page == 'home') class="active" @endif href="{{route('potral.home')}}">BERANDA</a>
                            </li>
                            <li class="nav-item">
                                <a href="#">PROFIL MADRASAH</a>
                                <ul class="sub-menu">
                                    <li><a href="#">Sejarah</a></li>
                                    <li><a href="#">Visi & Misi</a></li>
                                    <li><a href="#">Bid. Kesiswaan</a></li>
                                    <li><a href="#">Bid. Kepegawaian</a></li>
                                    <li><a href="#">Bid. Kurikulum</a></li>
                                    <li><a href="#">Bid. Sarana & Prasarana</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a href="{{route('portal.event')}}">KEGIATAN</a></li>
                            <li class="nav-item"><a href="{{route('potral.article')}}">ARTIKEL</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-4">
                <div class="right-icon text-right">
                    <ul>
                        <li><a href="#" id="search"><i class="fa fa-search"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
