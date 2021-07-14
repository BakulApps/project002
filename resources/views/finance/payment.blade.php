@extends('finance.layouts.master', ['title' => 'Pembayaran'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/finance/backend/js/payment.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Tagihan</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h5 class="card-title">DATA PEMBAYARAN</h5>
                </div>
                <table class="table datatable-payment table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA LENGKAP</th>
                        <th>KELAS</th>
                        <th>ITEM</th>
                        <th>PEMBAYARAN</th>
                        <th>TANGGAL TRANSFER</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
