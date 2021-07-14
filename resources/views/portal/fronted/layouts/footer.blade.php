<footer id="footer-part">
    <div class="footer-top pt-40 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-about mt-40">
                        <div class="logo">
                            <a href="#"><img src="{{asset('storage/portal/images/'. $setting->value('app_logo'))}}" alt="Logo"></a>
                        </div>
                        <p>{{$setting->value('app_desc')}}</p>
                        <ul class="mt-20">
                            <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-link mt-40">
                        <div class="footer-title pb-25">
                            <h6>Tautan</h6>
                        </div>
                        <ul>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Beranda</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Profil</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Kegiatan</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Artikel</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Unduhan</a></li>
                        </ul>
                        <ul>
                            <li><a href="#"><i class="fa fa-angle-right"></i>PPDB</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>SIMADU</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Raport Digital</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>E-Learning</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Alumni</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-link support mt-40">
                        <div class="footer-title pb-25">
                            <h6>Dukungan</h6>
                        </div>
                        <ul>
                            <li><a href="#"><i class="fa fa-angle-right"></i>FAQS</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Privacy</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Policy</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Support</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Documentation</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-address mt-40">
                        <div class="footer-title pb-25">
                            <h6><a href="#">Hubungi Kami</a></h6>
                        </div>
                        <ul>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <div class="cont">
                                    <p>{{$setting->value('school_address')}}</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="cont">
                                    <p>{{$setting->value('school_phone')}}</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="cont">
                                    <p>{{$setting->value('school_email')}}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright pt-10 pb-25">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright text-md-left text-center pt-15">
                        <p> &copy; 2020 Copyrights By <a target="_blank" href="#">{{$setting->value('school_name')}}</a></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="copyright text-md-right text-center pt-15">

                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
