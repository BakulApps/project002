@extends('graduate.layouts.master', ['title' => 'Peserta Didik'])
@section('js')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/styling/uniform.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pickers/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/apps/graduate/backend/js/student.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Data Siswa</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h5 class="card-title">DATA SISWA</h5>
                    <div class="header-elements">
                        <button type="button" class="btn btn-sm btn-primary btn-labeled btn-labeled-left" data-toggle="modal" data-target="#modal-upload"><b><i class="icon-upload4"></i></b>UNGGAH</button>
                    </div>
                </div>
                <table class="table datatable-student table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NISN</th>
                        <th>NISM</th>
                        <th>Kelas</th>
                        <th>TTL</th>
                        <th>JK</th>
                        <th>Nama Wali</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div id="modal-edit" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">UBAH DATA SISWA</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="student_id">
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" id="student_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">NISN</label>
                        <div class="col-sm-9">
                            <input type="text" id="student_nisn" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">NISM</label>
                        <div class="col-sm-9">
                            <input type="text" id="student_nism" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Kelas</label>
                        <div class="col-sm-9">
                            <input type="text" id="student_class" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Tempal Lahir</label>
                        <div class="col-sm-9">
                            <input type="text" id="student_place_birth" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Tanggal Lahir</label>
                        <div class="col-sm-9">
                            <input type="text" id="student_birthday" class="form-control daterange-time">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <select id="student_gender" class="form-control select">
                                <option value="L">Laki - laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Alamat</label>
                        <div class="col-sm-9">
                            <textarea id="student_address" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Nama Ayah</label>
                        <div class="col-sm-9">
                            <input type="text" id="student_father" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Nama Ibu</label>
                        <div class="col-sm-9">
                            <input type="text" id="student_mother" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="submit" class="btn bg-primary">SIMPAN</button>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-upload" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-white">
                    <h5 class="modal-title">Unggah Data Siswa</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p class="text-danger font-italic">Menggungah berkas berarti menghapus data sebelumnya.</p>
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="file" id="data_student" class="form-control-uniform-custom">
                            </div>
                        </div>
                    </div>
                    <p>Silahkan unduh template Data Siswa <a href="{{route('graduate.admin.student')}}/?_type=download&_data=student" class="badge badge-info">disini</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
