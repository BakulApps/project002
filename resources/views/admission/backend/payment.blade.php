@extends('admission.backend.layouts.master', ['title' => 'Data Pembayaran'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/admission/backend/js/payment.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Data Pembayaran</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-sm-inline">
                    <h5 class="card-title font-weight-semibold">DATA PEMBAYARAN</h5>
                    <div class="header-elements">
                        <div class="wmin-sm-200">
                            <select id="payment_status" class="form-control select2" data-fouc>
                                <option value="0">Semua</option>
                                <option value="1">Menunggu Pembayaran</option>
                                <option value="2">Menunggu Verifikasi</option>
                                <option value="3">Terverifikasi</option>
                                <option value="4">Pembayaran Tunai</option>
                            </select>
                        </div>
                    </div>
                </div>
                <table class="table datatable-payment table-bordered">
                    <thead>
                    <tr>
                        <th>No Inv.</th>
                        <th>Nama Siswa</th>
                        <th>Program</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Tangal Transfer</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div id="modal-student" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                @include('admission.backend.componens.form_student')
            </div>
        </div>
    </div>
    <div id="modal-payment" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">VERIFIKASI PEMBAYARAN</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="payment_id" value="">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Total Tagihan</label>
                                <input type="text" id="payment_invoice" class="form-control" value="" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label>Jumlah Pembayaran</label>
                                <input type="text" id="payment_amount" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <p class="font-weight-semibold">Infomasi Pembayaran</p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Jenis Bank</label>
                                <input type="text" id="payment_account_type" class="form-control" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label>Nomor Rekening</label>
                                <input type="text" id="payment_account_number" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Atas Nama</label>
                                <input type="text" id="payment_account_name" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tanggal & Jam Pembayaran</label>
                                <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                            </span>
                                    <input type="text" class="form-control daterange-single"  id="payment_transaction_date" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <p><a target="_blank" id="payment_transaction_file" href="">klik disini</a> untuk melihat bukti pembayaran.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-primary" id="submit" value="3">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>
@endsection
