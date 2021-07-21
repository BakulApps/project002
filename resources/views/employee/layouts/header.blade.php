<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                <i class="icon-display mr-2"></i>
                <span class="font-weight-semibold">{{$setting->value('app_name')}}</span> - {{$school->name(false)}}
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="{{route('employee.home')}}" class="breadcrumb-item"><i class="icon-display mr-2"></i> Root</a>
                @yield('breadcrumb')
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
