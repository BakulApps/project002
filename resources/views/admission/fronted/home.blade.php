@extends('admission.fronted.layouts.master')
@section('breadcrumb')
    <a href="#" class="breadcrumb-item active">Dashboard</a>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="font-weight-bold">Selamat Datang di Aplikasi {{$setting->value('app_alias')}} TP. {{$setting->value('app_year')}} {{$setting->value('school_name')}}</h3>
            <h4>Sebelum melakukan pendaftaran siapkan terlebih dahulu semua persyaratan guna memudahkan dalam pengisian
                formulir pendaftaran. Untuk persyaratan pendaftaran silahkan lihat dimenu Informasi. Silahkan unduh brosur PPDB Tahun PElajaran 2022/2023 disini.</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title font-weight-semibold">ALUR PENDAFTARAN</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="text-center col-md-2" data-trigger="hover" data-popup="popover" data-placement="top" title="Pengisian Formulir" data-content="Peserta PPDB melakukan pengisian formulir pada menu pendaftaran.">
                    <i class="icon-file-plus icon-1x text-info border-info border-2 rounded-round p-3 mb-1 mt-1"></i>
                    <h5 class="mb-0">Pengisian Formulir</h5>
                </div>
                <div class="text-center col-md-1 align-content-md-center">
                    <i class="icon-arrow-right7 icon-1x p-3 mb-1 mt-1"></i>
                </div>
                <div class="text-center col-md-2" data-trigger="hover" data-popup="popover" data-placement="top" title="Unggah Persyaratan" data-content="Peserta PPDB menggugah berkas persyaratan dimenu unggah dokumen dengan memasukkan kode registrasi.">
                    <i class="icon-upload icon-1x text-info border-info border-2 rounded-round p-3 mb-1 mt-1"></i>
                    <h5 class="mb-0">Unggah Persyaratan</h5>
                </div>
                <div class="text-center col-md-1 align-content-md-center">
                    <i class="icon-arrow-right7 icon-1x p-3 mb-1 mt-1"></i>
                </div>
                <div class="text-center col-md-2" data-trigger="hover" data-popup="popover" data-placement="top" title="Cetak Bukti Pendaftaran" data-content="Peserta PPDB mencetak bukti pendaftaran dengan memasukkan kode registrasi.">
                    <i class="icon-printer icon-1x text-info border-info border-2 rounded-round p-3 mb-1 mt-1"></i>
                    <h5 class="mb-0">Mencetak</h5>
                </div>
                <div class="text-center col-md-1 align-content-md-center">
                    <i class="icon-arrow-right7 icon-1x p-3 mb-1 mt-1"></i>
                </div>
                <div class="text-center col-md-2" data-trigger="hover" data-popup="popover" data-placement="top" title="Selesai" data-content="Peserta PPDB telah selesai melakukan pendaftaran. Pengumuman penerimaan akan ditampilkian di menu pengumuman.">
                    <i class="icon-check2 icon-1x text-info border-info border-2 rounded-round p-3 mb-1 mt-1"></i>
                    <h5 class="mb-0">Selesai</h5>
                </div>

            </div>
        </div>
    </div>
@endsection
