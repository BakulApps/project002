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
                            @foreach(\App\Models\Portal\Mainmenu::where('menu_parent', 0)->get() as $mainmenu)
                                @php($parentmenu = \App\Models\Portal\Mainmenu::where('menu_parent', $mainmenu->menu_id))
                            <li class="nav-item">
                                <a @if($page == $mainmenu->menu_name) class="active" @endif href="{{$mainmenu->menu_link}}">{{$mainmenu->menu_name}}</a>
                                @if($parentmenu->count() >= 1)
                                    <ul class="sub-menu">
                                        @foreach($parentmenu->get() as $parent)
                                            <li><a href="{{$parent->menu_link}}">{{$parent->menu_name}}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                            @endforeach
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
