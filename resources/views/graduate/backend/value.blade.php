@extends('graduate.layouts.master', ['title' => 'Penilaian'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/styling/uniform.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/graduate/backend/js/value.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Penilaian</span>
    <span class="breadcrumb-item active">Nilai Ujian</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h5 class="card-title">NILAI UJIAN</h5>
                    <div class="header-elements">
                        <button type="button" class="btn btn-primary btn-labeled btn-labeled-left ml-3" data-toggle="modal" data-target="#modal-upload"><b><i class="icon-upload4"></i></b>UNGGAH</button>
                    </div>
                </div>
                <table class="table table-sm table-bordered datatable-value">
                    <thead>
                    <tr class="text-center">
                        <td>NAMA SISWA</td>
                        @foreach($subjects as $subject)
                            <td>{{$subject->subject_code}}</td>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    </tbody>
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
                    <h5 class="modal-title">Unggah Nilai Ujian</h5>
                </div>
                <div class="modal-body">
                    <p class="text-danger font-italic">Menggungah berkas berarti menghapus data sebelumnya.</p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="file" id="value" class="form-control-uniform-custom">
                            </div>
                        </div>
                    </div>
                    <p>Silahkan unduh template Nilai Ijazah <a href="{{route('graduate.admin.value')}}/?_type=download&_data=value" class="badge badge-info">disini</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
