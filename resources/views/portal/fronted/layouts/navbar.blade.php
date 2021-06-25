<div class="header-top d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="header-contact text-lg-left text-center">
                    <ul>
                        <li><img src="{{asset('assets/apps/portal/fronted/images/icon/map.png')}}" alt="icon"><span>{{$setting->value('school_subdistric') .', '. $setting->value('school_distric')}}</span></li>
                        <li><img src="{{asset('assets/apps/portal/fronted/images/icon/email.png')}}" alt="icon"><span>{{$setting->value('school_email')}}</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="header-opening-time text-lg-right text-center">
                    <p>Jam Operasional : {{$setting->value('school_operational')}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
