@extends('admission.fronted.layouts.master', ['title' => 'Pembayaran Tagihan'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/admission/fronted/js/register_invoice.blade.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Root</span>
    <span class="breadcrumb-item active">Pembayaran Tagihan</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white header-elements-sm-inline">
                    <h5 class="card-title">DATA TAGIHAN</h5>
                </div>
                <table class="table datatable-invoice table-bordered">
                    <thead>
                    <tr>
                        <th>No Tagihan</th>
                        <th>Detail Tagihan</th>
                        <th>Status</th>
                        <th>Tanggal Terbit</th>
                        <th>Jatuh Tempo</th>
                        <th>Jumlah Tagihan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
