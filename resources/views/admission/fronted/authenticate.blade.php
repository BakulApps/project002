@extends('admission.fronted.layouts.master', ['title' => 'Authentikasi'])
@php($setting = new \App\Models\Admission\Setting())
@section('breadcrumb')
    <a href="#" class="breadcrumb-item active">Autentikasi</a>
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title font-weight-semibold">AUTENTIKASI DIGITAL SURAT</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-responsive font-weight-semibold">
                        <tbody>
                        <tr>
                            <td style="width: 35%;">NOMOR SURAT</td>
                            <td>:</td>
                            <td>{{isset($form->form_letter) ? $form->form_letter : null}}</td>
                        </tr>
                        <tr>
                            <td>TANGGAL SURAT</td>
                            <td>:</td>
                            <td>{{isset($form->form_date) ? \Carbon\Carbon::parse($form->form_date)->translatedFormat('d F Y') : null}}</td>
                        </tr>
                        <tr>
                            <td>NAMA TERANG</td>
                            <td>:</td>
                            <td>{{isset($form->student->student_name) ? $form->student->student_name : null}}</td>
                        </tr>
                        <tr>
                            <td>NISN</td>
                            <td>:</td>
                            <td>{{isset($form->student->student_nisn) ? $form->student->student_nisn : null}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="card-text mt-2 text-danger font-italic">
                        Pastikan data dicetakan surat sesuai dengan data yang ada yang tertera disini.
                    </div>
                </div>
                <div class="col-md-6 justify-content-center align-self-center">
                    @if(isset($form))
                    <h2 class="text-white text-center font-weight-bold bg-success">
                        DATA SURAT DITEMUKAN<br>
                        AUTENTIKASI BERHASIL
                    </h2>
                    @else
                    <h2 class="text-white text-center font-weight-bold bg-danger">
                        DATA SURAT TIDAK DITEMUKAN<br>
                        AUTENTIKASI GAGAL
                    </h2>
                    @endif
                    <div class="text-right">
                    <img src="{{asset('storage/admission/fronted/images/student/'. $form->student->student_nisn .'_qrcode.png')}}" style="width: 110px">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
