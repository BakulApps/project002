<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                <i class="icon-display mr-2"></i>
                <span class="font-weight-semibold">{{$title}}</span> - {{$setting->value('app_alias')}} TP. {{$setting->value('app_year')}}
                <small class="d-block text-muted">{{$school->name(false)}}</small>
            </h4>
        </div>
    </div>
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="{{route('admission.admin.home')}}" class="breadcrumb-item"><i class="icon-display mr-2"></i> Root</a>
                @yield('breadcrumb')
            </div>
            <a href="{{route('admission.admin.setting')}}" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
