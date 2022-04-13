@extends('admission.backend.layouts.master', ['title' => 'Data Biaya'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/admission/backend/js/master_cost.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Master Data</span>
    <span class="breadcrumb-item active">Data Biaya</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white header-elements-sm-inline">
                    <h5 class="card-title">DATA BIAYA</h5>
                </div>
                <table class="table datatable-cost table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Program</th>
                        <th>Boarding</th>
                        <th>Jenis Kelamin</th>
                        <th>Biaya Pendaftaran</th>
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
                            <input type="hidden" id="cost_id">
                            <div class="form-group">
                                <label>Nama Program :</label>
                                <select id="cost_program" data-placeholder="Pilih Program" class="form-control select">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Boarding/Non Boarding :</label>
                                <select id="cost_boarding" data-placeholder="Pilih Boarding" class="form-control select">
                                    <option></option>
                                    <option value="1">Ya</option>
                                    <option value="2">Tidak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin :</label>
                                <select id="cost_gender" data-placeholder="Pilih Jenis Kelamin" class="form-control select">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Biaya Pendaftaran :</label>
                                <input type="text" id="cost_amount" class="form-control" placeholder="240000">
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
