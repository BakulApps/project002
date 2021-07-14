@extends('finance.layouts.master', ['title' => 'Tagihan'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/finance/backend/js/invoice.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Tagihan</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h5 class="card-title">DATA TAGIHAN</h5>
                    <div class="header-elements">
                        <button type="button" class="btn btn-sm btn-primary btn-labeled btn-labeled-left" data-toggle="modal" data-target="#modal-upload"><b><i class="icon-upload4"></i></b>UNGGAH</button>
                    </div>
                </div>
                <table class="table datatable-invoice table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA LENGKAP</th>
                        <th>NISN</th>
                        <th>KELAS</th>
                        <th>TAGIHAN</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div id="modal-upload" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-white">
                    <h5 class="modal-title">Unggah Data Tagihan</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Berkas Unggahan</label>
                        <input type="file" id="data_invoice" class="form-control-uniform-custom">
                    </div>
                    <p class="font-italic">Berkas yang diunggah adalah file xls/xlsx eksport dari aplikasi keuangan madrasah.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
