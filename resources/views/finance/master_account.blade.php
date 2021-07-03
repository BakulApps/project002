@extends('finance.layouts.master', ['title' => 'Master Data'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/finance/backend/js/master_account.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Master Data</span>
    <span class="breadcrumb-item active">Akun Bank</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white header-elements-sm-inline">
                    <h5 class="card-title">AKUN BANK</h5>
                </div>
                <table class="table datatable-account table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>BANK</th>
                        <th>NOMOR REKENING</th>
                        <th>NAMA REKENING</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-white header-elements-inline">
                            <h5 class="card-title title-add">TAMBAH DATA</h5>
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="account_id">
                            <div class="form-group">
                                <label>BANK</label>
                                <select id="account_bank" data-placeholder="Pilih Bank" class="form-control select2">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>NOMOR REKENING</label>
                                <input type="text" id="account_number" class="form-control" placeholder="Ex. 1234567890">
                            </div>
                            <div class="form-group">
                                <label>NAMA REKENING</label>
                                <input type="text" id="account_name" class="form-control" placeholder="Ex. Tagihan Tahun Lalu">
                            </div>
                            <div class="form-group">
                                <label>BANK</label>
                                <select id="account_active" class="form-control select" data-fouc>
                                    <option value="1">Aktif</option>
                                    <option value="2">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-info btn-labeled btn-labeled-left btn-sm" id="submit" value="store"><b><i class="icon-floppy-disk"></i></b> Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
