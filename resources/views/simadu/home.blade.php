@extends('simadu.layouts.master', ['title' => 'Beranda'])
@section('jsscript')
    <script src="{{asset("assets/apps/simadu/js/home.js")}}"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="font-weight-semibold">Selamat Datang di {{$setting->value('app_name')}} ({{$setting->value('app_alias')}})</h3>
                    <h5 class="text-justify">Sistem Informasi Madrasah Terpadu (SIMADU) adalah fasilitas bagi Siswa dan Guru untuk menunjang
                        proses belajar mengajar. Bagi siswa, SIMADU memiliki fasilitas untuk merubah Biodata Pribadi, Laporan Hasil Belajar (Raport),
                        Jadwal Pelajaran, Administrasi Keuangan, dan lain-lain. Bagi Guru, SIMADU memiliki fasilitas khususnya untuk kegiatan belajar mengajar seperti,
                        presensi, jurnal kelas, dan lain-lain.
                    </h5>
                    @if(!session()->has('simadu.auth'))
                    <a href="{{route('simadu.login')}}" class="btn btn-outline-primary">Masuk Aplikasi Kesiswaan</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @if(session()->has('simadu.auth'))
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title font-weight-semibold">Informasi</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-justify">
                            Silahkan memperbarui informasi Pribadi, agar data pribadi benar-benar valid.
                        </p>
                    </div>
                </div>
            @else
            <div class="card">
                <div class="card-body">
                    <h5 class="font-weight-semibold text-center">CEK ADMINISTRASI</h5>
                    <div class="form-group">
                        <input type="text" id="student_nisn" class="form-control col-md-12" placeholder="Silahkan Masukkan NISN">
                    </div>
                    <div class="form-group">
                            <button type="button" class="btn bg-primary btn-labeled btn-labeled-left col-md-12" id="submit"><b><i class="icon-paperplane"></i></b> PERIKSA</button>
                    </div>
                    <p class="font-italic" id="forget">Lupa NISN? Klik <a href="{{route('simadu.data')}}">Disini</a>.</p>
                    <div class="row" id="lack_detail">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <tbody>
                                    <tr>
                                        <td>NAMA</td>
                                        <td style="width: 2%">:</td>
                                        <td id="student_name">#</td>
                                    </tr>
                                    <tr>
                                        <td>KELAS</td>
                                        <td>: </td>
                                        <td id="student_class">#</td>
                                    </tr>
                                    <tr>
                                        <td>KEKURANGAN</td>
                                        <td>:</td>
                                        <td id="student_lack">#</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="font-italic mt-3">Untuk tagihan detailnya silahkan masuk ke aplikasi.</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
