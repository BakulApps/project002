@extends('admission.fronted.layouts.master', ['title' => 'Informasi Pendaftaran'])
@php($setting = new \App\Models\Admission\Setting())
@section('breadcrumb')
    <a href="#" class="breadcrumb-item active">Persyaratan</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card-header bg-white header-elements-inline">
                <h6 class="card-title font-weight-bold">PENDAFTARAN ONLINE</h6>
            </div>
            <div class="card card-body border-top-info">
                <p class="text-muted">Sebelum melakukan pendaftaran siapkan dulu persyaratan, antara lain :</p>
                <p class="text-muted">1. Swafoto/Foto  Berseragam</p>
                <p class="text-muted">2. Foto Kartu Keluarga</p>
                <p class="text-muted">3. Foto Akta Kelahiran</p>
                <p class="text-muted">4. Foto KTP Orangtua</p>
                <p class="text-muted">5. Foto Surat Keterangan Lulus (SKL)</p>
                <p class="text-muted">6. Foto Ijazah (Bisa Menyusul)</p>
                <p class="text-muted">6. Foto Kartu Bantuan KIP/PKH/KKS (Jika Punya)</p>
                <div class="card card-body bg-light mb-2">
                    <p>Setelah semua persyaratan siap silahkan mengunjungi tautan berikut : <a href="{{route('admission.register')}}">{{route('admission.register')}}</a> Isikan informasi yang dibutuhkan seperti :</p>
                    <ul class="list list-unstyled mb-0">
                        <li><i class="icon-arrow-right5 mr-2"></i> Informasi Pribadi</li>
                        <li><i class="icon-arrow-right5 mr-2"></i> Informasi Tempat Tinggal</li>
                        <li><i class="icon-arrow-right5 mr-2"></i> Informasi Program Pilihan</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-body bg-light mb-2">
                            <p class="text-justify">
                                Setelah pendaftaran awal berhasil, silahkan melengkapi data dengan cara masuk mengunakan
                                NISN/NIK dan tanggal lahir yang telah di input di pendaftaran awal.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-img-actions">
                            <img class="img-fluid" src="{{asset('assets/apps/admission/fronted/images/login.png')}}" alt="">
                            <div class="card-img-actions-overlay">
                                <a href="{{asset('assets/apps/admission/fronted/images/login.png')}}" class="btn btn-outline bg-white text-white border-white border-2" data-popup="lightbox">
                                    Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-body bg-light mb-2">
                            <p>Pendaftaran telah selesai, jika informasi lengkap & persyaratan telah terunggah semua tombol cetak formulir akan aktif.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-img-actions">
                            <img class="img-fluid" src="{{asset('assets/apps/admission/fronted/images/print.png')}}" alt="">
                            <div class="card-img-actions-overlay">
                                <a href="{{asset('assets/apps/admission/fronted/images/print.png')}}" class="btn btn-outline bg-white text-white border-white border-2" data-popup="lightbox">
                                    Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="mt-3 text-muted font-italic">Jika merasa kusulitan dalam mendaftar silahkan Hubungi via Whatsapp 08229366506 </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-header bg-white header-elements-inline">
                <h6 class="card-title font-weight-bold">PENDAFTARAN ON THE SPOT</h6>
            </div>
            <div class="card card-body border-top-info">
                <p class="text-muted font">Silahkan kunjungi sekretariat PPDB {{$school->name(false)}} dengan membawa persayaratan sebagai berikut</p>
                <p class="text-muted font">1. Pasphoto 3x4 4 Lembar</p>
                <p class="text-muted font">2. FC Kartu Keluarga</p>
                <p class="text-muted font">3. FC Akta Kelahiran</p>
                <p class="text-muted font">4. FC KTP Orangtua</p>
                <p class="text-muted font">5. Surat Keterangan Lulus (SKL) (Bisa Menyusul)</p>
                <p class="text-muted font">6. FC Ijazah (Bisa Menyusul)</p>
                <p class="text-muted font">6. FC Kartu Bantuan KIP/PKH/KKS (Jika Punya)</p>

                <div class="card card-body bg-light mb-0">
                    <p>Serahkan berkas tersebut kepada petugas pendaftaran, data akan di inputkan kesistem dan simpan formulir pendaftaran yang telah di berikan petugas.</p>
                    <p>Jika membutuhkan brosur, silahkan <a href="{{$setting->value('link_brosur')}}">klik disini</a> </p>
                </div>
            </div>
        </div>
    </div>

@endsection
