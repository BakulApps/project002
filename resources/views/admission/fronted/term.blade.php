@extends('admission.fronted.layouts.master', ['title' => 'Informasi'])
@php($setting = new \App\Models\Admission\Setting())
@section('breadcrumb')
    <a href="#" class="breadcrumb-item active">Persyaratan</a>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="font-weight-semibold">Selamat Datang di Aplikasi {{$setting->value('app_subname')}} TP. {{$setting->value('app_year')}} {{$setting->value('school_name')}}</h3>
            <h4>Sebelum melakukan pendaftaran siapkan terlebih dahulu semua persyaratan guna memudahkan dalam pengisian
                formulir pendaftaran. Untuk persyaratan pendaftaran silahkan lihat dimenu Persyaratan.</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title font-weight-semibold">ALUR PENDAFTARAN</h6>
        </div>
        <div class="card-body">
            <table class="table table-responsive">
                <tbody>
                <tr>
                    <td>1.</td>
                    <td>Calon peserta didik mengisi formulir dimenu pendaftaran.</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Calon peserta didik masuk ke halaman pendaftaran menggunakan NISN dan tanggal lahir yang di daftarkan pada tahap sebelumnya.</td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>Calon peserta didik melengkapi data pada formulir pendaftaran.</td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>Calon peserta didik mencetak bukti pendaftaran.</td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td>Calon peserta didik mengikuti Tes Masuk.</td>
                </tr>
                <tr>
                    <td>6.</td>
                    <td>Setelah Calon peserta didik dinyatakan lulus tes, Calon peserta didik wajib melakukan daftar ulang dengan membawa Formulir pendaftaran yang dicetak pada tahap sebelumnya.</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
