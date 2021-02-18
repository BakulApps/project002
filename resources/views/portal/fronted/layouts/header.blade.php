<div class="header-logo-support pt-30 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="logo">
                    <a href="{{route('potral.home')}}">
                        <img src="{{asset('storage/portal/fronted/images/logo-2.png')}}" alt="Logo">
                    </a>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="support-button float-right d-none d-md-block">
                    <div class="support float-left">
                        <div class="icon">
                            <img src="{{asset('assets/portal/fronted/images/icon/support.png')}}" alt="icon">
                        </div>
                        <div class="cont">
                            <p>Butuh bantuan? hubungi kami</p>
                            <span>{{$setting->value('school_phone')}}</span>
                        </div>
                    </div>
                    <div class="button float-left">
                        <a href="#" class="main-btn">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
