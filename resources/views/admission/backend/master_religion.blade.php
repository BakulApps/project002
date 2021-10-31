@extends('admission.backend.layouts.master', ['title' => 'Data Agama'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/admission/backend/js/master_religion.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Master Data</span>
    <span class="breadcrumb-item active">Data Agama</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white header-elements-sm-inline">
                    <h5 class="card-title">DATA AGAMA</h5>
                </div>
                <table class="table datatable-religion table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>id</th>
                        <th>Nama</th>
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
                            <input type="hidden" id="religion_id">
                            <div class="form-group">
                                <label>Nama Agama</label>
                                <input type="text" id="religion_name" class="form-control" placeholder="Ex. Islam, Kristen, Protestan">
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
