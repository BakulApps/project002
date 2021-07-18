@extends('portal.backend.layouts.master', ['title' => 'Mainmenu'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/portal/backend/js/mainmenu.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Mainmenu</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">DATA MAINMENU</h6>
                    <div class="header-elements">
                        <button type="button" class="btn btn-primary btn-labeled btn-labeled-left font-weight-semibold" data-toggle="modal" data-target="#modal-mainmenu"><b><i class="icon-plus2"></i> </b>TAMBAH</button>
                    </div>
                </div>
                <table class="table datatable-mainmenu table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>INDUK</th>
                        <th>LINK</th>
                        <th>AKSI</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div id="modal-mainmenu" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-white">
                    <h5 class="modal-title font-weight-semibold title">Tambah Mainmenu</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="menu_id">
                    <div class="form-group">
                        <label>Induk Menu : </label>
                        <select data-placeholder="Pilih Induk..." class="form-control select-parent" id="menu_parent" data-fouc>
                            <option></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Menu : </label>
                        <input type="text" id="menu_name" placeholder="Ex. Beranda" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Link Menu : </label>
                        <input type="text" id="menu_link" placeholder="Ex. https://darul-hikmah.sch.id" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="submit" value="store" class="btn btn-sm bg-primary btn-labeled btn-labeled-left"><b><i class="icon-floppy-disk"></i></b>SIMPAN</button>
                    <button type="button" class="btn btn-sm bg-danger btn-labeled btn-labeled-left" data-dismiss="modal"><b><i class="icon-close2"></i> </b>KELUAR</button>
                </div>
            </div>
        </div>
    </div>
@endsection
