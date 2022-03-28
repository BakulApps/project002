@extends('admission.backend.layouts.master', ['title' => 'Data Biaya'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/admission/backend/js/master_bank.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Master Data</span>
    <span class="breadcrumb-item active">Data Bank</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white header-elements-sm-inline">
                    <h5 class="card-title">DATA BANK</h5>
                </div>
                <table class="table datatable-bank table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tipe Bank</th>
                        <th>Nomer Rekening</th>
                        <th>Nama Rekening</th>
                        <th>Status</th>
                        <th>Aksi</th>
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
                            <input type="hidden" id="bank_id">
                            <div class="form-group">
                                <label>Tipe Bank :</label>
                                <input type="text" id="bank_type" class="form-control" placeholder="Ex. BNI, BCA, BNI">
                            </div>
                            <div class="form-group">
                                <label>Nomor Rekening :</label>
                                <input type="text" id="bank_number" class="form-control" placeholder="Ex. 123456789123456">
                            </div>
                            <div class="form-group">
                                <label>Nama Rekening :</label>
                                <input type="text" id="bank_name" class="form-control" placeholder="Ex. Muhammad Arif Muntaha">
                            </div>
                            <div class="form-group">
                                <label>Status :</label>
                                <select id="bank_status" data-placeholder="Pilih Status" class="form-control select2">
                                    <option></option>
                                    <option value="0">Tidak Aktif</option>
                                    <option value="1">Aktif</option>
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
